<?php
class Student {
    protected $name;
    protected $number;
    
    public function __construct($num, $name) {
        $this->number = $num;
        $this->name = $name;
    }
    public function getName() {

        return $this->name;
        
            
        }
        public function getNumber() {
        return $this->number;
        
            
        }
}


?>