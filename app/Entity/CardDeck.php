<?php

namespace App\Entity;


class CardDeck extends Card
{
    public const PATTERN = ['SPADE', 'HEART', 'DIAMOND', 'CLOVER'];
    public const NUMBER = 13;

    public function deck(): array
    {
        $shuffledDeck = array();
        $deck = $this->generateCards();
        shuffle($deck);
        foreach ($deck as $card) {
            $shuffledDeck[] = $card;
        }
        return $shuffledDeck;
    }

    private function generateCards(): array
    {
        $cards = array();

        foreach (self::PATTERN as $pattern) {
            for($i = 1; $i<=self::NUMBER; $i++) {
                $card = new Card();
                $denomination = $this->numberToDenomination($i);
                $point = $this->numberToPoint($i);
                $card->setNumber($denomination);
                $card->setPattern($pattern);
                $card->setPoint($point);
                $cards[] = $card;
            }
        }
        return $cards;
    }

    private function numberToPoint(int $number): int
    {
        if ($number >= 11) {
            return 10;
        } else {
            return $number;
        }
    }


    private function numberToDenomination(int $number):string
    {
        if($number == 1) {
            $denomination = "A";
        } else if($number == 11) {
            $denomination = "J";
        } else if($number == 12) {
            $denomination = "Q";
        } else if($number == 13) {
            $denomination = "K";
        } else {
            $denomination = $number;
        }
        return $denomination;
    }

    public function drawCard()
    {
        $deck = $this->deck();
        return array_pop($deck);
    }

}
