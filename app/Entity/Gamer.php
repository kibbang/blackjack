<?php

namespace App\Entity;
use App\Domain\Player;

class Gamer implements Player
{
    private $cards;
    private $turn;
    private $name;

    public function __construct(String $name)
    {
        $this->cards = array();
        $this->name = $name;
    }

    public function receivedCards(Card $card)
    {
        $this->cards[] = $card;
        $this->showCards();
    }
    public function showCards()
    {
        foreach ($this->cards as $card)
        {
            echo $card->toString();
            echo "\n";
        }

    }
    public function openCards(): array
    {
        return $this->cards;
    }

    public function turnOff(): void
    {
        $this->setTurn(false);
    }

    public function turnOn(): void
    {
        $this->setTurn(true);
    }

    public function isTurn(): bool
    {
        return $this->turn;
    }
    /**
     * @param mixed $turn
     */
    private function setTurn($turn): bool
    {
        $this->turn = $turn;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }
}
