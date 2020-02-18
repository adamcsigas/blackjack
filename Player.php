<?php

class Player {
    private $name;
    private $cards;

    public function __construct(string $name) {
        $this->name = $name;
        $this->cards = [];
    }

    public function getName(){return $this->name;} //winnerhez kell
    public function getCards() { return $this->cards; }
    public function setCards($cards) { $this->cards[] = $cards; }

    public function amountOfCards() {
        return count($this->cards,COUNT_RECURSIVE);
    }

    public function calculatePoints()
    {
        $sum = 0;
        $Cards = $this->getCards();

        foreach ($Cards as $card) {
            $sum += $card->getCardValue();
        }
        return $sum;
    }

    public function calculateHand()
    {
        $hand = null;
        $Cards = $this->getCards();

        foreach ($Cards as $card) {
            $hand = $hand . $card->__toString() . ', '; //todo: last time should not add ', ' ;
        }
        return $hand;
    }
}

