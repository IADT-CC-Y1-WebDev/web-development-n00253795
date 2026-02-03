<?php

require_once __DIR__ . '/Student.php';

class Postgrad extends Student {
    protected $supervisor;
    protected $topic;

    public function __construct($name, $number, $supervisor, $topic) {
        parent::__construct($number, $name);
        $this->supervisor = $supervisor;
        $this->topic = $topic;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }

    public function getTopic() {
        return $this->topic;
    }

    // Override __toString()
    public function __toString() {
        return "Postgrad: " .
               $this->getName() . " (" . $this->getNumber() . "), " .
               "Supervisor: " . $this->supervisor . ", " .
               "Topic: " . $this->topic;
    }
}
