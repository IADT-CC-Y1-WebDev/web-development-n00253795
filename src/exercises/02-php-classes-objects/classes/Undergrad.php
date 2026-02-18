<?php

require_once __DIR__ . '/Student.php';

// Undergrad inherits from Student
class Undergrad extends Student {

    protected $course;
    protected $year;

    public function __construct($num, $name, $course, $year) {
        parent::__construct($num, $name);
        $this->course = $course;
        $this->year = $year;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getYear() {
        return $this->year;
    }

    // Override __toString() to include course and year
    public function __toString() {
        return "Undergrad: {$this->name} ({$this->number}), {$this->course}, Year {$this->year}";
    }
}


