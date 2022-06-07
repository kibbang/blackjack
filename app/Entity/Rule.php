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
            $isBust = $this->isBust($pointSum);
            if ($pointSum > $highScore && !$isBust) {
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

    private function isBust($sum): bool
    {
        if ($sum > 21) {
            return true;
        } else {
            return false;
        }
    }
}
