<?php

namespace App\Entity;

class Rule
{
    private const MAX_POINT = 21;

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
        if ($sum > self::MAX_POINT) {
            return true;
        } else {
            return false;
        }
    }
}
