<?php

class Pagament {
    
    private $id;
    private $banc;
    private $ref_externa;
    private $data;
    private $estat;
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property");
        }
    }
    
}

?>
