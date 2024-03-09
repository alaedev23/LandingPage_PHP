 <?php

 class Esdeveniment {
    
    private $id;
    private $titol;
    private $subtitol;
    private $dates;
    private $imatge;

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
            'titol' => $this->titol,
            'subtitol' => $this->subtitol,
            'dates' => $this->dates,
            'imatge' => $this->imatge
        ];
    }
    
}

