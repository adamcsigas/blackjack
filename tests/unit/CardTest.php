<?php

namespace Csigusz\Blackjack;

class CardTest extends \PHPUnit\Framework\TestCase
{
    private $testCardKing;
    private $testCardAce;
    private $testCardNormalValue;
    private $testRankInvalidCard;

    public function setUp()
    {
        $this->testCardKing = new Card('D','K') ;
        $this->testCardAce = new Card('H', 'A');
        $this->testCardNormalValue = new Card('H', '7');
        $this->testRankInvalidCard = new Card('H', 'X');
    }

    /** @test */
    public function it_should_get_card_numeric_values() {

        $this->assertEquals($this->testCardKing->getNumericValue(), 10);
        $this->assertEquals($this->testCardAce->getNumericValue(), 11);
        $this->assertEquals($this->testCardNormalValue->getNumericValue(), 7);
        $this->assertNull($this->testRankInvalidCard->getNumericValue());
    }

     /** @test */
    public function it_should_return_card_as_string_representation() {

        $this->assertEquals($this->testCardKing->__toString(),'DK');
        $this->assertEquals($this->testCardAce->__toString(),'HA');
        $this->assertEquals($this->testCardNormalValue->__toString(),'H7');
        $this->assertEquals($this->testRankInvalidCard->__toString(),'HX'); //todo might throw exception?
    }
}

