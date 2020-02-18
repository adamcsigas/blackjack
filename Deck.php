<?php

class Deck {

    const
        CARDTYPES = ['C','D','H','S'],
        VALUES = ['2','3','4','5','6','7','8','9','10','J','Q','K','A'];

    private $deck = [];


    public function __construct()
    {
        $this->createDeck();
        $this->shuffleDeck();
    }

    private function createDeck()
    {
        foreach (self::CARDTYPES as $type)
        {
            foreach (self::VALUES as $values)
            {
                $this->deck[] = new card($type,$values);
            }
        }
    }

    private function shuffleDeck() { shuffle($this->deck);}

    public function getDeck(){return $this->deck;}
    public function setDeck($deck) { $this->deck[] = $deck;}

    public function pickCard()
    {
        $pickedCard = array_shift($this->getDeck());
        array_shift($this->deck);
        return $pickedCard;
    }
}

