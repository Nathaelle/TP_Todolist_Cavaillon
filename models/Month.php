<?php 

class Month {

    const MONTH_NAME_FR = [1 => "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

    private $monthName;
    private $year;
    private $first;
    private $last;

    public function __construct(int $num, int $year) {

        $num = (($num % 12) === 0)? 12 : $num % 12;
        $this->setMonthName($num);
        $this->setYear($year);
        $this->setFirst($num);
        $this->setLast();
    }

    public function getMonthName(): string {
        return $this->monthName;
    }

    public function setMonthName(int $num) {
        $this->monthName = Month::MONTH_NAME_FR[$num];
    }

    public function getYear(): int {
        return $this->year;
    }

    public function setYear(int $year) {
        $this->year = $year;
    }

    public function getFirst(): DateTimeImmutable {
        return $this->first;
    }

    public function setFirst(int $num) {
        $this->first = new DateTimeImmutable("{$this->year}-$num-01");
    }

    public function getLast(): DateTimeImmutable {
        return $this->last;
    }

    public function setLast() {
        $this->last = $this->first->modify('last day of');
    }











}