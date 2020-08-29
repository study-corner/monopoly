<?php

namespace App\Board;

use App\Player\Player;

class Street
{
    private ?Player $owner = null;
    private ?Card $card = null;
    private bool $cardOnStreet = true;
    private string $name = '';
    private int $price = 0;
    private int $fee = 0;

    public function getOwner(): Player
    {
        return $this->owner;
    }

    public function setOwner(Player $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function isOwner(Player $player): bool
    {
        return spl_object_hash($player) === spl_object_hash($this->owner);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFee(): int
    {
        return $this->fee;
    }

    public function setFee(int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): self
    {
        $this->card = $card;
        if (null !== $card && !$card->hasStreet()) {
            $card->setStreet($this);
        }

        return $this;
    }

    public function hasCard(): bool
    {
        return null !== $this->card;
    }

    public function isCardOnStreet(): bool
    {
        return $this->cardOnStreet;
    }

    public function setCardOnStreet(bool $cardOnStreet): self
    {
        $this->cardOnStreet = $cardOnStreet;

        return $this;
    }
}