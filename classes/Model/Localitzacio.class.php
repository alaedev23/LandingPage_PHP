<?php

class Localitzacio {

    private $id;
    private $lloc;
    private $adreca;
    private $localitat;
    
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
