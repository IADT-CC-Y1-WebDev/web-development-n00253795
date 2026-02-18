<?php

class Student {
    protected $number;
    protected $name;

    // Registry of all students
    private static $students = [];

    public function __construct($num, $name) {
        $this->number = $num;
        $this->name = $name;

        // Add this student to the registry
        self::$students[$num] = $this;
    }

    // Remove student from registry
    public function leave() {
        unset(self::$students[$this->number]);
        echo "Student {$this->name} has left the registry<br>";
    }

    // Static method to get all students
    public static function findAll() {
        return self::$students;
    }

    // Static method to find a student by number
    public static function findByNumber($num) {
        return self::$students[$num] ?? null;
    }

    // Static method to get the total number of students
    public static function getCount() {
        return count(self::$students);
    }

    public function getName() {
        return $this->name;
    }

    public function getNumber() {
        return $this->number;
    }

    public function __toString() {
        return "Student: {$this->name} ({$this->number})";
    }

    // Destructor
    public function __destruct() {
        echo "Student {$this->name} has been destroyed<br>";
    }
}
