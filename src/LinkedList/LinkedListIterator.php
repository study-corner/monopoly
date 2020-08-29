<?php

namespace App\LinkedList;

class LinkedListIterator implements \Iterator
{
    private LinkedList $list;
    private int $position = 0;

    public function __construct(LinkedList $list)
    {
        $this->list = $list;
    }

    public function current()
    {
        return $this->list->get($this->position);
    }

    public function next(): void
    {
        ++$this->position;
        if ($this->list->total() === $this->position) {
            $this->position = 0;
        }
    }

    public function move(int $steps): void
    {
        for ($i=0; $i<$steps; $i++) {
            $this->next();
        }
    }

    public function key()
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return $this->list->isExist($this->position);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}