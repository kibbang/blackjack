<?php

namespace App\Entity;

use App\Domain\Player;
use Illuminate\Console\Concerns\InteractsWithIO;

class Game
{
    use InteractsWithIO;
    private const INIT_RECEIVE_CARD_COUNT = 2;
    private const STOP_RECEIVE_CARD = "0";

    public function game()
    {
        echo "=======================게임시작=============================\n";
        $dealer = new Dealer();
        $gamer = new Gamer("user");
        $player = array(new Gamer("user"), new Dealer());
        $rule = new Rule();
        $cardDeck = new CardDeck();

        $this->firstPhase($cardDeck, $gamer, $dealer);

    }

    public function firstPhase(CardDeck $cardDeck, $gamer, $dealer)
    {
        echo "=======================처음 카드 2장을 드로우 합니다.=============================\n";
        echo "=====================카드 목록=======================\n";
        for ($i = 0; $i < self::INIT_RECEIVE_CARD_COUNT; $i++)
        {

//            foreach ($player as $players)
//            {
//                $card = $cardDeck->drawCard();
//                $player->receivedCards($card);
//            }
            $card = $cardDeck->drawCard();
            $gamer->receivedCards($card);

            $card2 = $cardDeck->drawCard();
            $dealer->receivedCards($card2);
        }
    }

}
