<?php
namespace App\Domain;
use App\Entity\Card;



interface Player
{
    public function receivedCards(Card $card);

    public function showCards();

    public function openCards(): array;

    public function getName(): String;

    public function isTurn(): Bool;

    public function turnOn(): void;

    public function turnOff(): void;

}
