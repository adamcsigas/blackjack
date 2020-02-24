<?php

namespace App\Models;

class UserTest extends \PHPUnit\Framework\TestCase {

    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    /** @test */
    public function ThatWeCanGetTheFirstName()
    {
        $this->user->setFirstName('Bill');

        $this->assertEquals($this->user->getFirstName(), "Bill");
    }

    /** @test */
    public function ThatWeCanGetTheLastName()
    {
        $this->user->setLastName('Goes');

        $this->assertEquals($this->user->getLastName(), "Goes");
    }
}