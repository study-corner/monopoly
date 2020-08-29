<?php

namespace App\Tests\Board;

use App\Board\Board;
use App\Board\BoardItem;
use App\Board\TokenWalker;
use PHPUnit\Framework\TestCase;

class BoardWalkerTest extends TestCase
{
    public function testLinkedList(): void
    {
        $first = new BoardItem();
        $second = new BoardItem();
        $third = new BoardItem();
        $fourth = new BoardItem();
        $fifth = new BoardItem();

        $linkedList = new Board();
        $linkedList->add($first)->add($second)->add($third)->add($fourth)->add($fifth);
        $testList = [$first, $second, $third, $fourth, $fifth];

        $i = 0;
        $listIterator = new TokenWalker($linkedList);
        foreach ($listIterator as $item) {
            if ($i < 5) {
                self::assertEquals(spl_object_hash($testList[$i]), spl_object_hash($item));
            }
            if ($i > 14) {
                break;
            }
            ++$i;
        }

        self::assertEquals(15, $i);

        $listIterator->rewind();
        $listIterator->move(7);
        self::assertEquals(spl_object_hash($third), spl_object_hash($listIterator->current()));
        self::assertEquals(2, $listIterator->key());
    }
}