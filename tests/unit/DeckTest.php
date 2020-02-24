<?php

namespace Csigusz\Blackjack;

class DeckTest extends \PHPUnit\Framework\TestCase
{
    private $testDeck = [];

    protected function setUp()
    {
        $this->testDeck = new Deck();
    }

    /** @test */
    public function can_create_deck()
    {
        $this->assertNotNull($this->testDeck);
    }
    /** @test */
    public function can_pick_a_card()
    {
        $this->assertObjectHasAttribute('type',$this->testDeck->pickCard());
        $this->assertObjectHasAttribute('value',$this->testDeck->pickCard());
        $this->assertObjectHasAttribute('numericValue',$this->testDeck->pickCard());
    }
}