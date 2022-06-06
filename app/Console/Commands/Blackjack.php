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
        $game = new Game();
        echo $game->game();
   }
}
