<?php
require_once('./classes.php');

class Game {
    private $deck = [];
    private $player;
    private $dealer;
    private $winner = "none had blackjack. \n";

    public function __construct()
    {
        $this->initializeGame();
    }

    function createPlayers()
    {
        $this->player = new Player('sam');
        $this->dealer = new Player('dealer');
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

    function isBlackJack() :bool
    {
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

    function isBusted()
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if( ($playerPoints == 22 && $dealerPoints == 22) ||
            $playerPoints == 22)
        {
            $this->setWinner($this->dealer->getName());
            return true;
        } else if ($dealerPoints == 22) {
            $this->setWinner($this->player->getName());
            return true;
        } else {
            return false;
        }
    }

    public function getWinner() {return $this->winner;}
    public function setWinner($winner){$this->winner = $winner;}

    function evaluateStartingHand()
    {
        if($this->isBlackJack() || $this->isBusted()) {
            return $this->getWinner();
        }
    }

    function initializeGame()
    {
        $this->createPlayers();
        $this->deck = new Deck();
        $this->drawCards();
        $this->evaluateStartingHand();
    }

    function startGame()
    {
        $this->initializeGame();

        if ($this->winner === null) {
            $this->drawCardUntil(player, 17, dealer);
            $this->drawCardUntil(dealer, $this->getPlayerScore(player), player);
        }

        $playerHand = $this->getPlayerHand();
        $dealerHand = $this->getPlayerHand();

        return $this->winner;
    }

    function getParticipantsHands()
    {
        $playersName = $this->player->getName();
        $playersHand = $this->player->calculateHand();
        $dealersName = $this->dealer->getName();
        $dealersHand = $this->dealer->calculateHand();

        return "${playersName} : ${playersHand} \n${dealersName} : ${dealersHand} \n";
    }

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

print_r($testGame);
print_r($testGame->getParticipantsHands());

