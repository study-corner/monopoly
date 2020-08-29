<?php

namespace App\Tests\LinkedList;

use App\LinkedList\LinkedList;
use App\LinkedList\LinkedListIterator;
use App\LinkedList\ListItem;
use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase
{
    public function testLinkedList(): void
    {
        $first = new ListItem();
        $second = new ListItem();
        $third = new ListItem();
        $fourth = new ListItem();
        $fifth = new ListItem();

        $linkedList = new LinkedList();
        $linkedList->add($first)->add($second)->add($third)->add($fourth)->add($fifth);
        $testList = [$first, $second, $third, $fourth, $fifth];

        $i = 0;
        $listIterator = new LinkedListIterator($linkedList);
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