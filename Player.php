<?php

class Player
{
    private $name;
    private $cards;

    public function __construct($name) {
        $this->name = $name;
        $this->cards = [];
    }

    public function getName(){return $this->name;}
    public function getCards() { return $this->cards; }
    public function setCards($cards) { $this->cards[] = $cards; }

    public function amountOfCards() {
        return count($this->cards,COUNT_RECURSIVE);
    }
}

