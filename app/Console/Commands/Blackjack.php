<?php

namespace App\Console\Commands;

use App\Entity\CardDeck;
use App\Entity\Dealer;
use App\Entity\Gamer;
use App\Entity\Rule;
use App\Entity\Game;
use Illuminate\Console\Command;

class Blackjack extends Command
{
    private const INIT_RECEIVE_CARD_COUNT = 2;
    private const STOP_RECEIVE_CARD = "0";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blackjack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
   {
//        $game = new Game();
//        $game->game();
        $this->game();
   }

    public function game()
    {
        echo "=======================게임시작=============================\n";
        $dealer = new Dealer();
        $gamer = new Gamer("user");
        $player = array(new Gamer("user"), new Dealer());
        $rule = new Rule();
        $cardDeck = new CardDeck();

        $this->firstPhase($cardDeck, $gamer, $dealer);
        $this->playPhase($cardDeck, $gamer, $dealer);
    }

    private function playPhase($cardDeck, $gamer, $dealer)
    {
        $isGamerTurn = false;
        $isDealerTurn = false;

        while(true) {
            if(!$this->confirm("카드를 뽑으시겠습니까?")) {
                $isGamerTurn = true;
            } else {
                $card = $cardDeck->drawCard();
                $gamer->receivedCards($card);
            }

            if(!$this->confirm("카드를 뽑으시겠습니까?")) {
                $isDealerTurn = true;
            } else {
                $card = $cardDeck->drawCard();
                $dealer->receivedCards($card);
            }

            if($isGamerTurn && $isDealerTurn) {
                break;
            }
        }

    }

    private function firstPhase(CardDeck $cardDeck, $gamer, $dealer)
    {
        echo "=======================처음 카드 2장을 드로우 합니다.=============================\n";
        for ($i = 0; $i < self::INIT_RECEIVE_CARD_COUNT; $i++)
        {

//            foreach ($player as $players)
//            {
//                $card = $cardDeck->drawCard();
//                $player->receivedCards($card);
//            }
            echo "====================유저 패=============================\n";
            $card = $cardDeck->drawCard();
            $gamer->receivedCards($card);

            echo "====================딜러 패=============================\n";
            $card2 = $cardDeck->drawCard();
            $dealer->receivedCards($card2);
        }
    }
}
