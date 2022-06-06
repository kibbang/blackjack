<?php

namespace App\Entity;

use App\Domain\Player;

class Rule
{
    public function getWinner(Player $player): ?Player
    {
        $highScorePlayer = null;
        $highScore = 0;

        foreach ($player as $players) {
            $pointSum = $this->getPointSum($player->openCards());

            if ($pointSum > $highScore) {
                $highScorePlayer = $player;
                $highScore = $pointSum;
            }
        }
        return $highScorePlayer;
    }

    private function getPointSum(Card $card): int
    {
        $sum = 0;

        foreach ($card as $cards)
        {
            $sum += $card->getPoint();
        }

        return $sum;
    }
}
