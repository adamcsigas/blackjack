<?php

namespace Csigusz\Blackjack;

class Card
{
    private $type;
    private $value;
    private $numericValue;

    const TYPES = ['C', 'D', 'H', 'S'];
    const VALUES = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
        'A' => 11,
    ];

    public function __construct(string $type, string $rank)
    {
        $this->type = $type;
        $this->value = $rank;
        $this->numericValue = self::VALUES[$rank];
    }

    public function getNumericValue(): int
    {
        return $this->numericValue;
    }

    public function __toString()
    {
        return $this->type . $this->value;
    }
}

