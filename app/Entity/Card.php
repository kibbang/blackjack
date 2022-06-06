<?php

namespace App\Entity;

class Card
{
    private $pattern;
    private $number;
    private $point;

//    public function __construct(string $pattern, string $number, int $point)
//    {
//        $this->pattern = $pattern;
//        $this->number = $number;
//        $this->point = $point;
//    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }


    /**
     * @param mixed $point
     */
    public function setPoint($point): void
    {
        $this->point = $point;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @param mixed $pattern
     */
    public function setPattern($pattern): void
    {
        $this->pattern = $pattern;
    }

    public function toString(): string
    {
        return "card: { ".$this->pattern." ".$this->number." }";
    }

    /**
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
    }
}

