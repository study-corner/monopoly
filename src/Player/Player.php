<?php

namespace App\Player;

use App\Board\Card;
use App\Board\GameOverException;
use App\Board\TokenWalker;

class Player
{
    private string $name;
    private TokenWalker $tokenWalker;
    private int $wallet = 2500;
    private array $cards = [];

    public function __construct(string $name, TokenWalker $takenWalker)
    {
        $this->name = $name;
        $this->tokenWalker = $takenWalker;
    }

    public function setMoney(int $money): Player
    {
        $this->wallet = $money;

        return $this;
    }

    public function rollDice(): int
    {
        $dice = 1;
        try {
            $dice = random_int(1, 6);
        } catch (\Exception $e) {
        }

        return $dice;
    }

    public function moveToken(int $steps): void
    {
        $this->tokenWalker->move($steps);
    }

    public function tokenAt()
    {
        return $this->tokenWalker->key();
    }

    public function addCard(Card $card): self
    {
        $this->cards[spl_object_hash($card)] = $card;

        return $this;
    }

    public function removeCard(Card $card): void
    {
        unset($this->cards[spl_object_hash($card)]);
    }

    public function hasCard(Card $card): bool
    {
        return array_key_exists(spl_object_hash($card), $this->cards);
    }

    public function income(int $money): void
    {
        $this->wallet += $money;
    }

    public function pay(int $money): void
    {
        $this->wallet -= $money;
        if ($this->wallet < 0) {
            throw new GameOverException(sprintf('Player %s run out money', $this->name));
        }
    }

    public function actWithCard(): void
    {
        $placeholder = $this->tokenWalker->current();
        $street = $placeholder->getStreet();
        if ($street->isCardOnStreet()) {
            $price = $street->getPrice();
            $this->pay($price);
            $street->setCardOnStreet(false);
            $street->setOwner($this);
            $card = $street->getCard();
            $this->addCard($card);
        } else if (!$street->isOwner($this)) {
            $owner = $street->getOwner();
            $fee = $street->getFee();
            $owner->income($fee);
            $this->pay($fee);
        }
    }
}