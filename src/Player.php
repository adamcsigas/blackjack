<?php

namespace Csigusz\Blackjack;

class Player //todo dealer player külön osztály
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

    public function calculateAmountOfCards(): int
    {
        return count($this->cards);
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

    public function calculateHand(): string
    {
        return implode(', ', $this->cards);
    }
}

