<?php

namespace App\LinkedList;

class ListItem
{
    private ?ListItemContext $context = null;
    private ?ListItem $parent = null;
    private ?ListItem $child = null;

    public function getContext(): ?ListItemContext
    {
        return $this->context;
    }

    public function setContext(?ListItemContext $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getParent(): ?ListItem
    {
        return $this->parent;
    }

    public function setParent(ListItem $parent): self
    {
        $this->parent = $parent;
        $child = $parent->getChild();
        if (null === $child || !$this->isItemsSame($this, $child)) {
            $this->parent->setChild($this);
        }

        return $this;
    }

    public function getChild(): ?ListItem
    {
        return $this->child;
    }

    public function setChild(ListItem $child): self
    {
        $this->child = $child;
        $parent = $child->getParent();
        if (null === $parent || !$this->isItemsSame($this, $parent)) {
            $this->child->setParent($this);
        }

        return $this;
    }

    private function isItemsSame(ListItem $item, ListItem $foreignItem): bool
    {
        return spl_object_hash($item) === spl_object_hash($foreignItem);
    }
}