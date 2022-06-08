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
            $tmp_arr[] = $pointSum;
            $isBust = $this->isBust($pointSum);
            if ($pointSum > $highScore && !$isBust) {
                $highScorePlayer = $players;
                $highScore = $pointSum;
            }
        }
        $isDraw = $this->isDraw(array_values($tmp_arr));
        if($isDraw) {
            $highScorePlayer = null;
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

    private function isDraw($pointArr): bool
    {
        if($pointArr[0] == $pointArr[1]) {
            return true;
        } else {
            return false;
        }
    }
}
