<?php

namespace App\Entity;

class Rule
{
    public function getWinner($player)
    {
        $highScorePlayer = null;
        $highScore = 0;

        foreach ($player as $players) {
            $pointSum = $this->getPointSum($players->openCards());

            if ($pointSum > $highScore) {
                $highScorePlayer = $players;
                $highScore = $pointSum;
            }
        }

        return $highScorePlayer;
    }

    private function getPointSum($card): int
    {
        $sum = 0;

        foreach ($card as $cards)
        {
            $sum += $cards->getPoint();
        }

        return $sum;
    }
}
