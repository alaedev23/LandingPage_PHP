<?php

class Data {
    
    private $id;
    private $data;
    private $hora;
    
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
    
    public function __debugInfo() {
        return [
            'id' => $this->id,
            'data' => $this->data,
            'hora' => $this->hora,
        ];
    }
}


?>
