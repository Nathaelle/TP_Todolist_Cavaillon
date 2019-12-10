<?php

use PHPUnit\Framework\TestCase;
use Models\Month;

class MonthTest extends TestCase {

    private $month;

    function setUp(): void {
        $this->month = new Month(12, 2019);
        $this->assertInstanceOf(Month::class, $this->month);
    }

    public function testGetMonthName() {
        $this->assertEquals("Décembre", $this->month->getMonthName());
    }




    //function tearDown(): void {}

}