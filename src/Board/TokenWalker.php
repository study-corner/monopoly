<?php

namespace App\Board;

class TokenWalker implements \Iterator
{
    private Board $board;
    private int $position = 0;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function current()
    {
        return $this->board->get($this->position);
    }

    public function next(): void
    {
        ++$this->position;
        if ($this->board->total() === $this->position) {
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
        return $this->board->isExist($this->position);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}