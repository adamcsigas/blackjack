<?php

namespace Csigusz\Blackjack;

class Deck
{

    private $deck = [];

    public function __construct()
    {
        $this->createDeck();
        $this->shuffleDeck();
    }

    private function createDeck()
    {
        foreach (Card::TYPES as $type) {
            foreach (Card::VALUES as $key=>$value) {
                $this->deck[] = new Card($type, $key);
            }
        }
    }

    private function shuffleDeck()
    {
        shuffle($this->deck);
    }

    public function setDeck($deck) //fileread
    {
        $this->deck[] = $deck;
    }

    public function pickCard(): Card
    {
        return array_shift($this->deck);
    }
}

