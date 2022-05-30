<?php

namespace App\Entity;

class Game

{
    /**
     * @var CardDeck
     */
    private $cardDeck;
    private $dealer;
    private $player;

    public function __construct(CardDeck $cardDeck, Dealer $dealer, Player $player)
    {
        $this->cardDeck = $cardDeck;
        $this->dealer = $dealer;
        $this->player = $player;
    }

    public function test() {
        echo "abc";
        echo "def";
    }
}
