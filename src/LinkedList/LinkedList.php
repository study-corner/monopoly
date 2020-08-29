<?php

namespace App\LinkedList;

class LinkedList
{
    /**
     * @var ListItem[]|array
     */
    private array $storage = [];

    public function add(ListItem $item): self
    {
        $this->isListEmpty() ? $this->addFirstItemToList($item) : $this->appendItemToList($item);

        return $this;
    }

    public function get(int $position): ?ListItem
    {
        return $this->storage[$position] ?? null;
    }

    public function isExist(int $position): bool
    {
        return isset($this->storage[$position]);
    }

    public function total(): int
    {
        return count($this->storage);
    }

    private function isListEmpty(): bool
    {
        return 0 === $this->total();
    }

    private function addFirstItemToList(ListItem $item): void
    {
        $this->linkAndAddItemToList($item, $item, $item);
    }

    private function appendItemToList(ListItem $item): void
    {
        $this->linkAndAddItemToList($item, $this->lastItem(), $this->firstItem());
    }

    private function linkAndAddItemToList(ListItem $item, ListItem $parent, ListItem $child): void
    {
        $item->setParent($parent);
        $item->setChild($child);
        $this->storage[] = $item;
    }

    private function lastItem(): ListItem
    {
        return $this->storage[count($this->storage) - 1];
    }

    private function firstItem(): ListItem
    {
        return $this->storage[0];
    }
}