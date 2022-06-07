<?php

namespace App\Console\Commands;

use App\Entity\Card;
use App\Entity\CardDeck;
use App\Entity\Dealer;
use App\Entity\Gamer;
use App\Entity\Rule;
use App\Entity\Game;
use Illuminate\Console\Command;

class Blackjack extends Command
{
    private const INIT_RECEIVE_CARD_COUNT = 2;
    private const STOP_RECEIVE_CARD = "no";
    private const KEEP_GO_RECEIVE_CARD = "yes";
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
        $this->info("블랙잭 게임을 시작합니다.");
        $this->info("=========================");
//        $dealer = new Dealer();
//        $gamer = new Gamer("USER");
        $players = array(new Gamer("USER"), new Dealer());
        $rule = new Rule();
        $cardDeck = new CardDeck();

//        $this->firstPhase($cardDeck, $gamer, $dealer);
//        $this->playPhase($cardDeck, $gamer, $dealer);
        $firstAfterPlayers = $this->firstPhase($cardDeck, $players);
        $endGamePlayers = $this->playPhase($cardDeck, $firstAfterPlayers);

        $winner = $rule->getWinner($endGamePlayers);
        $this->info("승자는".$winner->getName());
    }

    private function playPhase($cardDeck, $players)
    {
//        $isGamerTurn = false;
//        $isDealerTurn = false;

        while(true) {
//            if(!$this->confirm("카드를 뽑으시겠습니까?")) {
//                $isGamerTurn = true;
//            } else {
//                $card = $cardDeck->drawCard();
//                $gamer->receivedCards($card);
//            }
//
//            if(!$this->confirm("카드를 뽑으시겠습니까?")) {
//                $isDealerTurn = true;
//            } else {
//                $card = $cardDeck->drawCard();
//                $dealer->receivedCards($card);
//            }
//
//            if($isGamerTurn && $isDealerTurn) {
//                break;
//            }
            $cardReceivedPlayer = $this->receivedAllCardPlayer($cardDeck, $players);

            if ($this->isAllPlayerTurnOff($cardReceivedPlayer))
            {
                break;
            }
        }
        return $cardReceivedPlayer;
    }

    private function firstPhase($cardDeck, $players)
    {
//        echo "=======================처음 카드 2장을 드로우 합니다.=============================\n";
        $this->info("최초 2장을 뽑습니다.");
        $this->info("==============================================");
        for ($i = 0; $i < self::INIT_RECEIVE_CARD_COUNT; $i++)
        {
            foreach ($players as $player)
            {
                $this->info($player->getName()."의 차례입니다.");
                $this->info("현재".$player->getName()."의 보유 카드 목록");
                $card = $cardDeck->drawCard();
                $player->receivedCards($card);
                echo "\n";
            }
//            echo "====================유저 패=============================\n";
//            $card = $cardDeck->drawCard();
//            $gamer->receivedCards($card);
//
//            echo "====================딜러 패=============================\n";
//            $card2 = $cardDeck->drawCard();
//            $dealer->receivedCards($card2);
        }
        return $players;
    }

    private function receivedAllCardPlayer($cardDeck, $players)
    {
        foreach ($players as $player) {
            $this->info($player->getName()."의 차례입니다.");
            if($this->isReceiveCard() == self::KEEP_GO_RECEIVE_CARD) {
                $card = $cardDeck->drawCard();
                $player->receivedCards($card);
                $player->turnOn();
            } else {
                $player->turnOff();
            }
        }
        return $players;
    }

    private function isAllPlayerTurnOff($players): bool
    {
//        if (!empty($players)) {
//            foreach ($players as $player) {
//                if ($player->isTurn()) {
//                    return false;
//                }
//            }
//        }
//        \Log::debug(var_export($players, true));
        foreach ($players as $player) {
            if ($player->isTurn()) {
                return false;
            }
        }
        return true;
    }

    private function isReceiveCard(): string
    {
        if($this->confirm("카드를 뽑으시겠습니까? (종료하시려면 no를 입력하세요)")) {
            return self::KEEP_GO_RECEIVE_CARD;
        } else {
            return self::STOP_RECEIVE_CARD;
        }
    }
}
