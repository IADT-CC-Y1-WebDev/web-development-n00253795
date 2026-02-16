<?php

require_once __DIR__ . '/Student.php';

// Postgrad inherits from Student
class Postgrad extends Student {

    protected $supervisor;
    protected $topic;

    public function __construct($num, $name, $supervisor, $topic) {
        // Call parent constructor first
        parent::__construct($num, $name);

        // Set Postgrad-specific properties
        $this->supervisor = $supervisor;
        $this->topic = $topic;
    }

    // Getter for supervisor
    public function getSupervisor() {
        return $this->supervisor;
    }

    // Getter for topic
    public function getTopic() {
        return $this->topic;
    }

    // Override __toString() to include supervisor and topic
    public function __toString() {
        return "Postgrad: {$this->name} ({$this->number}), Supervisor: {$this->supervisor}, Topic: {$this->topic}";
    }
}
