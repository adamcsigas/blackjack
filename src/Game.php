<?php

namespace Csigusz\Blackjack;

class Game
{
    private $deck = [];
    private $player;
    private $dealer;
    private $winner = '';

    public function __construct()
    {
        $this->runGame();
        $this->printFinalResult();
    }

    private function createPlayers()
    {
        $this->player = new Player('sam');
        $this->dealer = new Player('dealer');
    }

    private function drawCards()
    {
        $numberOfParticipants = 2;
        $cardsNeededToStartGame = $numberOfParticipants * 2;

        for ($i = 0; $i < $cardsNeededToStartGame; $i++) {
            $cardsOfPlayer = $this->player->calculateAmountOfCards();
            $cardsOfDealer = $this->dealer->calculateAmountOfCards();
            $pickedCard = $this->deck->pickCard();

            if ($cardsOfPlayer <= $cardsOfDealer) {
                $this->player->addCard($pickedCard);
            } else {
                $this->dealer->addCard($pickedCard);
            }
        }
    }

    public function isBlackJack(): bool
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if ($playerPoints == 21) {
            $this->setWinner($this->player);
            return true;
        } else if ($dealerPoints == 21) {
            $this->setWinner($this->dealer);
            return true;
        } else {
            return false;
        }
    }

    public function isBusted(): bool
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if ($playerPoints == 22) {
            $this->setWinner($this->dealer);
            return true;
        } else if ($dealerPoints == 22) {
            $this->setWinner($this->player);
            return true;
        } else {
            return false;
        }
    }

    public function getWinner()
    {
        return print_r($this->winner);
    }

    public function setWinner(string $winner)
    {
        $this->winner = $winner;
    }

    function evaluateStartingHand()
    {
        if ($this->isBlackJack() || $this->isBusted()) {
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

    public function runGame() //todo 02
    {
        $this->initializeGame();

        if ($this->winner === '') {
            $this->drawCardUntil($this->player, 16, $this->dealer);
            if (!$this->isBusted()) {
                $this->drawCardUntil($this->dealer,$this->player->calculatePoints(), $this->player);
            }
        }
    }



    public function printFinalResult()
    {
        $playersName = $this->player;
        $playersHand = $this->player->calculateHand();
        $dealersName = $this->dealer;
        $dealersHand = $this->dealer->calculateHand();
        $winner = $this->getWinner(); //1??!?!?!!

        return print_r("${winner} \n${playersName} : ${playersHand} \n${dealersName} : ${dealersHand} \n");
    }

    public function drawCardUntil(Player $participantA, int $score, Player $participantB)
    {
        $pickedCard = $this->deck->pickCard();

        while ($participantA->calculatePoints() <= $score) {
            $participantA->addCard($pickedCard);
            if ($this->isBusted()) {
                return $this->setWinner($participantB);
            }
        }
        return 'not yet implemented';
    }
}

