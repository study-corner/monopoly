<?php

namespace App\Board;

use App\Player\Player;

class BoardSetup
{
    private Board $board;

    public function __construct()
    {
        $this->board = new Board();

        $bank = (new Player('Bank', new TokenWalker($this->board)))->setMoney(1000000000);
        $streets = $this->createStreets($bank);

        for ($i=0; $i<10; $i++) {
            $placeHolder = new BoardItem();
            $placeHolder->setStreet($streets[$i]);
            $this->board->add($placeHolder);
        }
    }

    public function createPlayer(string $name): Player
    {
        $tokenWalker = new TokenWalker($this->board);

        return new Player($name, $tokenWalker);
    }

    private function createStreets(Player $bank): array
    {
        $s1 = (new Street())->setCard(new Card())->setName('S1')->setPrice(30)->setFee(5)->setOwner($bank);
        $s2 = (new Street())->setCard(new Card())->setName('S2')->setPrice(40)->setFee(15)->setOwner($bank);
        $s3 = (new Street())->setCard(new Card())->setName('S3')->setPrice(50)->setFee(20)->setOwner($bank);
        $s4 = (new Street())->setCard(new Card())->setName('S4')->setPrice(60)->setFee(25)->setOwner($bank);
        $s5 = (new Street())->setCard(new Card())->setName('S5')->setPrice(70)->setFee(30)->setOwner($bank);
        $s6 = (new Street())->setCard(new Card())->setName('S6')->setPrice(80)->setFee(35)->setOwner($bank);
        $s7 = (new Street())->setCard(new Card())->setName('S7')->setPrice(90)->setFee(40)->setOwner($bank);
        $s8 = (new Street())->setCard(new Card())->setName('S8')->setPrice(100)->setFee(45)->setOwner($bank);
        $s9 = (new Street())->setCard(new Card())->setName('S9')->setPrice(110)->setFee(50)->setOwner($bank);
        $s10 = (new Street())->setCard(new Card())->setName('S10')->setPrice(120)->setFee(55)->setOwner($bank);
//        $s11 = (new Street())->setCard(new Card())->setName('S11')->setPrice(130)->setFee(60)->setOwner($bank);
//        $s12 = (new Street())->setCard(new Card())->setName('S12')->setPrice(140)->setFee(65)->setOwner($bank);
//        $s13 = (new Street())->setCard(new Card())->setName('S13')->setPrice(150)->setFee(70)->setOwner($bank);
//        $s14 = (new Street())->setCard(new Card())->setName('S14')->setPrice(160)->setFee(75)->setOwner($bank);
//        $s15 = (new Street())->setCard(new Card())->setName('S15')->setPrice(170)->setFee(80)->setOwner($bank);
//        $s16 = (new Street())->setCard(new Card())->setName('S16')->setPrice(180)->setFee(85)->setOwner($bank);
//        $s17 = (new Street())->setCard(new Card())->setName('S17')->setPrice(190)->setFee(90)->setOwner($bank);
//        $s18 = (new Street())->setCard(new Card())->setName('S18')->setPrice(200)->setFee(95)->setOwner($bank);
//        $s19 = (new Street())->setCard(new Card())->setName('S19')->setPrice(210)->setFee(100)->setOwner($bank);
//        $s20 = (new Street())->setCard(new Card())->setName('S20')->setPrice(220)->setFee(105)->setOwner($bank);

        return [
            $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10,
//            $s11, $s12, $s13, $s14, $s15, $s16, $s17, $s18, $s19, $s20
        ];
    }
}