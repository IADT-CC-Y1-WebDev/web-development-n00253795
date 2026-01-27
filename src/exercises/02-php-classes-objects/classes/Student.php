<?php
class Student {
    protected $name;
    protected $number;
    
    public function __construct($num, $name) {
        if ($num === "") {
            throw new Exception("Number cannot be empty!");
        }
        $this->number = $num;
        $this->name = $name;
    }
    public function getName() {
        return $this->name;  

        }
        public function getNumber() {
        return $this->number; 

        }
        public function __toString() {
        $format = "Student:  %s, %s";
        return sprintf($format, $this->name, $this->number);  
    }
    public function __destruct() {
        echo "Student {$this->name} has left the system.<br>";
    }
}





?>