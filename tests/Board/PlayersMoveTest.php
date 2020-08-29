<?php

namespace App\Tests\Board;

use App\Board\BoardSetup;
use App\Board\GameOverException;
use PHPUnit\Framework\TestCase;

class PlayersMoveTest extends TestCase
{
    public function testPlayersMoves(): void
    {
        $this->expectException(GameOverException::class);

        $boardSetup = new BoardSetup();
        $player1 = $boardSetup->createPlayer('First player');
        $player2 = $boardSetup->createPlayer('Second player');

        while (true) {
            $player1->moveToken($player1->rollDice());
            $player1->actWithCard();

            $player2->moveToken($player2->rollDice());
            $player2->actWithCard();
        }
    }
}