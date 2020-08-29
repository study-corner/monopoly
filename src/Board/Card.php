<?php

namespace App\Board;

class Card
{
    private ?Street $street = null;

    public function getStreet(): Street
    {
        return $this->street;
    }

    public function setStreet(Street $street): self
    {
        $this->street = $street;
        if (!$street->hasCard()) {
            $street->setCard($this);
        }

        return $this;
    }

    public function hasStreet(): bool
    {
        return null !== $this->street;
    }
}