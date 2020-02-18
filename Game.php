<?php
require_once('./classes.php');

class Game
{

    private $deck = [];
    private $player;
    private $dealer;
    private $winner = 'szalami';

    public function getWinner() {return $this->winner;}
    public function setWinner($winner){$this->winner = $winner;}

    //for test
    public function getPlayer(){return $this->player;}
    public function getDealer(){return $this->dealer;}
    //

    public function __construct()
    {
        $this->initializeGame();
    }

    function createPlayers()
    {
        $this->player = new Player('sam');
        $this->dealer = new Player('dealer');
    }

    function initializeGame()
    {
        $this->createPlayers();
        $this->deck = new Deck();
        $this->drawCards();
        //$this->isBlackJack();
        $this->evaluateStartingHand();
    }

    function drawCards()
    {
        $numberOfParticipants = 2;
        $cardsNeededToStartGame = $numberOfParticipants * 2;

        for ($i = 0; $i < $cardsNeededToStartGame; $i++) {
            $cardsOfPlayer = $this->player->amountOfCards();
            $cardsOfDealer = $this->dealer->amountOfCards();
            $pickedCard = $this->deck->pickCard();

            if ($cardsOfPlayer <= $cardsOfDealer) {
                $this->player->setCards($pickedCard);
            } else {
                $this->dealer->setCards($pickedCard);
            }
        }
    }

//    function startGame() {
//
//        $this->initializeGame();
//        $winner = $this->evaluateStartingHand();
//
//        if($winner === null)
//        {
//            $this->drawCardUntil(player,17,dealer);
//            $this->drawCardUntil(dealer,$this->getPlayerScore(player),player);
//        }
//
//        $playerHand = $this->getPlayerHand();
//        $dealerHand = $this->getPlayerHand();
//
//        return $winner;
//    }

    function isBlackJack() {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if (($playerPoints == 21 && $dealerPoints == 21) ||
             $playerPoints == 21)
        {
            $this->setWinner($this->player->getName());
            return true;
        } else if ($dealerPoints == 21) {
            $this->setWinner($this->dealer->getName());
            return true;
        } else {
            return false;
        }

    }

    function isBusted() {}


    function evaluateStartingHand()
    {
        if ($this->isBlackJack()) {
            return $this->getWinner();
        }
        if ($this->isBusted()) {
            return $this->winner;
        }
        return $this->winner;;
    }

//    function getPlayerScore($participant) {} //jatekos
//    function setPlayerScore($participant) {}
//
//
//    function drawCardUntil($participantA,$score,$participantB) {
//        while($this->getPlayerScore($participantA) < $score)
//        {
//            $this->drawCard($participantA);
//            $this->setPlayerScore($participantA);
//            if($this->isBusted())
//            {
//                return $winner = $participantB;
//            }
//        }
//        $this->setPlayerHand();
//    }

}

$testGame = new Game();

print_r($testGame->getWinner());
