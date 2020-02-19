<?php

namespace Csigusz\Blackjack;

//const szamok kiszervezése

class Game
{
    /* @var Deck */
    private $deck;

    private $winner = null;

    /* @var Player */
    private $player;

    /* @var Player */
    private $dealer;

    public function __construct()
    {
        $this->runGame();
        $this->printWinner();
        $this->printFinalResult();
    }

    private function createPlayers()
    {
        $this->player = new Player('sam');
        $this->dealer = new Player('dealer');
    }

    private function drawCards($cardsToDraw)
    {
        for ($i = 0; $i < $cardsToDraw; $i++) {
            $this->player->addCard($this->deck->pickCard());
            $this->dealer->addCard($this->deck->pickCard());
        }
    }

    public function isBlackJack(): bool
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if ($playerPoints == 21) { //const 21
            $this->setWinner($this->player);
            return true;
        } else if ($dealerPoints == 21) {
            $this->setWinner($this->dealer);
            return true;
        }
        return false;
    }

    public function isBusted(): bool
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if ($playerPoints > 21) {
            $this->setWinner($this->dealer);
            return true;
        } else if ($dealerPoints > 21) {
            $this->setWinner($this->player);
            return true;
        }
        return false;
    }

    //if written well, this countScores() is totally not needed
    function countScores() //todo if none busted and dealer has more point no one wins. <- this solution ugly af
    {
        $playerPoints = $this->player->calculatePoints();
        $dealerPoints = $this->dealer->calculatePoints();

        if ($dealerPoints > $playerPoints && $dealerPoints < 22) {
            $this->setWinner($this->dealer);
        }
    }

    public function printWinner()
    {
        echo "$this->winner\n";
    }

    public function setWinner(string $winner)
    {
        $this->winner = $winner;
    }

    private function initializeGame()
    {
        $this->createPlayers();
        $this->deck = new Deck();
        $this->drawCards(2);
    }

    public function isTheGameOver(): bool
    {
        return $this->isBlackJack() || $this->isBusted();
    }

    public function drawCardUntil(Player $participant, int $reachScore)
    {
        while ($participant->calculatePoints() < $reachScore) {
            $participant->addCard($this->deck->pickCard());
            if ($this->isBusted()) {
                break;
            }
        }
    }

    public function continueGame()
    {
        if (!$this->isTheGameOver()) {
            $this->drawCardUntil($this->player, 17);
            if (!$this->isBusted()) {
                $this->drawCardUntil($this->dealer, $this->player->calculatePoints());
            }
        }
    }

    private function runGame()
    {
        $this->initializeGame();
        $this->continueGame();
        $this->countScores();
    }

    public function printFinalResult()
    {
        $playersName = $this->player;
        $playersHand = $this->player->stringifyHand();
        $dealersName = $this->dealer;
        $dealersHand = $this->dealer->stringifyHand();

        echo "${playersName} : ${playersHand} \n${dealersName} : ${dealersHand} \n";
    }
}

