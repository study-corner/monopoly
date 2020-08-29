<?php

namespace App\Board;

use App\Player\Player;

class Board
{
    /**
     * @var Player[]|array
     */
    private array $players = [];
    /**
     * @var BoardItem[]|array
     */
    private array $storage = [];

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }

    public function getPlayer(int $position)
    {
        return $this->players[$position];
    }

    public function add(BoardItem $item): self
    {
        $this->isListEmpty() ? $this->addFirstItemToList($item) : $this->appendItemToList($item);

        return $this;
    }

    public function get(int $position): ?BoardItem
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

    private function addFirstItemToList(BoardItem $item): void
    {
        $this->linkAndAddItemToList($item, $item, $item);
    }

    private function appendItemToList(BoardItem $item): void
    {
        $this->linkAndAddItemToList($item, $this->lastItem(), $this->firstItem());
    }

    private function linkAndAddItemToList(BoardItem $item, BoardItem $parent, BoardItem $child): void
    {
        $item->setParent($parent);
        $item->setChild($child);
        $this->storage[] = $item;
    }

    private function lastItem(): BoardItem
    {
        return $this->storage[count($this->storage) - 1];
    }

    private function firstItem(): BoardItem
    {
        return $this->storage[0];
    }
}