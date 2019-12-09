<?php 

class Month {

    const MONTH_NAME_FR = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

    private $monthName;
    private $year;

    public function __construct(int $num, int $year) {
        $this->monthName = Month::MONTH_NAME_FR[$num - 1];
        $this->year = $year;
    }

    public function getMonthName(): string {
        return $this->monthName;
    }

    public function setMonthName(string $name) {
        $this->monthName = $name;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function setYear(int $year) {
        $this->year = $year;
    }











}