<?php

namespace App\Entity;


class CardDeck
{
    const PATTERN = ['spade', 'heart', 'diamond', 'clover'];
    const NUMBER = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13'];

    public static function deck() {
        foreach (self::PATTERN as $pattern) {
            foreach (Self::NUMBER as $number) {
                $deck[] = new static($pattern, $number);
            }
        }

        shuffle($deck);

        return $deck;
    }
}
