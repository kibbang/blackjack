<?php

namespace App\Entity;

class Card
{
    protected $pattern;
    protected $number;

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
}

