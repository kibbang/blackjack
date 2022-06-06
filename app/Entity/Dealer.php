<?php

namespace App\Entity;
use App\Domain\Player;

class Dealer implements Player
{
    private $cards;
    private $turn;
    private const CAN_RECEIVE_POINT = 16;
    private const DEALER = "DEALER";

    public function __construct()
    {
        $this->cards = array();
    }

    public function receivedCards(Card $card)
    {
        if ($this->isReceived()) {
            $this->cards[] = $card;
            $this->showCards();
        } else {
            echo "카드의 총 합이 17이상입니다. 더이상 카드를 받을 수 없습니다.\n";
        }
    }

    public function showCards()
    {
        foreach ($this->cards as $card)
        {
            echo $card->toString();
            echo "\n";
        }
    }

    public function isTurn(): bool
    {
        return $this->turn;
    }

    public function openCards(): array
    {
        return $this->cards;
    }

    private function setTurn($turn)
    {
        $this->turn = $turn;
    }

    public function turnOn(): void
    {
        $this->setTurn(true);
    }

    public function turnOff(): void
    {
        $this->setTurn(false);
    }
    public function getName(): string
    {
        return self::DEALER;
    }

    private function isReceived(): bool
    {
        return $this->getPointSum() <= self::CAN_RECEIVE_POINT;
    }

    private function getPointSum():int
    {
        $sum = 0;
        foreach ($this->cards as $card) {
            $sum += $card->getPoint();
        }
        return $sum;
    }
}
