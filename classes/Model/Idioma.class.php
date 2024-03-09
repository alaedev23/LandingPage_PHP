<?php 

class Idioma {
    
    public $id;
    public $iso;
    public $imatge;
    public $actiu;
    public $created_at;
    public $updated_at;
    
    private $traduccions;
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a idioma");
        }
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a idioma");
        }
    }
    
    public function __debugInfo() {
        return [
            'id' => $this->id,
            'iso' => $this->iso,
            'imatge' => $this->imatge,
            'actiu' => $this->actiu,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'traduccions' => $this->traduccions
        ];
    }
    
}

?>