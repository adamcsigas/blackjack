<?php
require_once('./classes.php');

class Game
{

    private $deck = [];
    private $player;
    private $dealer;
    private $winner = null;

    /**
     * @return null
     */
    public function getWinner(){return $this->winner;}
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
        //$this->evaluateStartingHand();
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

    function calculatePoints($participant)
    {
        $sum = 0;

        foreach ($participant as $key => $value) {
            $sum += $value->getCardValue();
        }
        return $sum;
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
        $playerPoints = $this->calculatePoints($this->player);
        $dealerPoints = $this->calculatePoints($this->dealer);
        return $playerPoints;
    }

    function isBusted() {}


    function evaluateStartingHand()
    {
        if ($this->isBlackJack()) {
            return $this->winner;
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

$blackJack = new Game();
$playerCards = $blackJack->getPlayer()->getCards();
print_r($playerCards);

print_r($player);


