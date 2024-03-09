<?php 

class Traduccio {
    
    public $id;
    public $variable;
    public $idioma_id;
    public $valor;
    public $created_at;
    public $updated_at;
    
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
            'variable' => $this->variable,
            'idioma_id' => $this->idioma_id,
            'valor' => $this->valor,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    
}

?>