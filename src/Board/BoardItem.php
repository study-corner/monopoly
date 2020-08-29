<?php

namespace App\Board;

class BoardItem
{
    private ?Street $street = null;
    private ?BoardItem $parent = null;
    private ?BoardItem $child = null;

    public function getStreet(): Street
    {
        return $this->street;
    }

    public function setStreet(Street $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getParent(): ?BoardItem
    {
        return $this->parent;
    }

    public function setParent(BoardItem $parent): self
    {
        $this->parent = $parent;
        $child = $parent->getChild();
        if (null === $child || !$this->isItemsSame($this, $child)) {
            $this->parent->setChild($this);
        }

        return $this;
    }

    public function getChild(): ?BoardItem
    {
        return $this->child;
    }

    public function setChild(BoardItem $child): self
    {
        $this->child = $child;
        $parent = $child->getParent();
        if (null === $parent || !$this->isItemsSame($this, $parent)) {
            $this->child->setParent($this);
        }

        return $this;
    }

    private function isItemsSame(BoardItem $item, BoardItem $foreignItem): bool
    {
        return spl_object_hash($item) === spl_object_hash($foreignItem);
    }
}