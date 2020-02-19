<?php

namespace Csigusz\Blackjack;

//todo dealer player külön osztály

class Player
{
    private $name;
    private $cards = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    public function calculatePoints(): int
    {
        return array_reduce(
            $this->cards,
            function ($sum, Card $card) {
                return $sum + $card->getNumericValue();
            },
            0
        );
    }

    public function stringifyHand(): string
    {
        return implode(', ', $this->cards);
    }
}

