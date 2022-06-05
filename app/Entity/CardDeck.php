<?php

namespace App\Entity;


class CardDeck
{
    const PATTERN = ['SPADE', 'HEART', 'DIAMOND', 'CLOVER'];
    const NUMBER = 13;

    public function deck()
    {
        $deck = $this->generateCards();
        shuffle($deck);
        foreach ($deck as $card) {
            \Log::debug(var_export($card, true));
        }
    }

    private function generateCards(): array
    {
        $cards = array();

        foreach (self::PATTERN as $pattern) {
            for($i = 1; $i<=self::NUMBER; $i++) {
                $card = new Card($pattern,$i);
                $denomination = $this->numberToDenomination($i);
                $card->setNumber($denomination);
                $card->setPattern($pattern);
                $cards[] = $card;
            }
        }
        return $cards;
    }


    private function numberToDenomination(int $number):string
    {
        $denomination = "";

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

}
