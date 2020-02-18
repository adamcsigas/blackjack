<?php


class Card
{
    protected $type;
    protected $value;

    function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    function getCardValue()
    {
        if($this->value === 'A') {
            $value = 11;
        } else {
            $value = is_numeric($this->value) ? $this->value : 10;
        }
        return  $value;
    }

    function __toString()
    {
        return $this->type . '' . $this->value;
    }
}

