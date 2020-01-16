<?php

use PHPUnit\Framework\TestCase;
use Models\Month;

class MonthTest extends TestCase {

    private $month;

    function setUp(): void {
        $this->month = new Month(12, 2019);
        $this->assertInstanceOf(Month::class, $this->month);
    }

    public function testGetters() {
        $this->assertEquals("Décembre", $this->month->getMonthName());
        $this->assertEquals(2019, $this->month->getYear());
        $this->assertInstanceOf(DateTimeImmutable::class, $this->month->getFirst());
        $this->assertInstanceOf(DateTimeImmutable::class, $this->month->getLast());

    }

    public function testSetMonthName() {
        $this->month->setMonthName(9);
        $this->assertEquals("Septembre", $this->month->getMonthName());
        $this->month->setMonthName(-9);
        $this->assertEquals("Septembre", $this->month->getMonthName());
        $this->month->setMonthName(13);
        $this->assertEquals("Janvier", $this->month->getMonthName());
        $this->month->setMonthName(24);
        $this->assertEquals("Décembre", $this->month->getMonthName());
    }

    /**
     * @dataProvider years
     */
    public function testSetYear($entree, $sortie) {
        $this->month->setYear($entree);
        $this->assertEquals($sortie, $this->month->getYear());
    }

    public function years()
    {
        return [
            [2011, 2011],
            [1990, 2019],
            [2030, 2019]
        ];
    }

    //function tearDown(): void {}

}