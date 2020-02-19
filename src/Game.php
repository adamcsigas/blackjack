<?php

namespace Csigusz\Blackjack;

//todo if none busted and dealer has more point no one wins

class Game
{
    public $deck = [];
    private $player;
    private $dealer;
    private $winner = null;

    public function __construct()
    {
        $this->runGame();
        $this->getWinner();
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

        if ($playerPoints > 21) {
            $this->setWinner($this->dealer);
            return true;
        } else if ($dealerPoints > 21) {
            $this->setWinner($this->player);
            return true;
        } else {
            return false;
        }
    }

    public function getWinner()
    {
        return print_r("$this->winner\n");
    }

    public function setWinner(string $winner)
    {
        $this->winner = $winner;
    }

    public function isTheGameOver()
    {
        if ($this->isBlackJack() || $this->isBusted()) {
            return true;
        }
        return false;
    }

    private function initializeGame()
    {
        $this->createPlayers();
        $this->deck = new Deck();
        $this->drawCards();
    }

    private function runGame()
    {
        $this->initializeGame();

        if (!$this->isTheGameOver()) {
            $this->drawCardUntil($this->player, 16);
            if (!$this->isBusted()) {
                $this->drawCardUntil($this->dealer, $this->player->calculatePoints());
            }
        }
    }

    public function drawCardUntil(Player $participant, int $reachScore)
    {
        while ($participant->calculatePoints() <= $reachScore) {
            $pickedCard = $this->deck->pickCard();
            $participant->addCard($pickedCard);
            if ($this->isBusted()) {
                break;
            }
        }
    }

    public function printFinalResult()
    {
        $playersName = $this->player;
        $playersHand = $this->player->calculateHand();
        $dealersName = $this->dealer;
        $dealersHand = $this->dealer->calculateHand();

        return print_r("${playersName} : ${playersHand} \n${dealersName} : ${dealersHand} \n");
    }
}

