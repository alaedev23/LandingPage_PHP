<?php

class Entrada  {
    
    private $id;
    private $fila;
    private $butaca;
    private $dni;
    private $esdeveniment;
    private $data;
    private $localitzacio;
    private $zona;
    private $pagament;
    
    private $esdeveniment_id;
    private $data_id;
    private $loc_id;
    private $zona_id;
    private $pagament_id;
    
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
            'fila' => $this->fila,
            'butaca' => $this->butaca,
            'dni' => $this->dni,
            'esdeveniment' => $this->esdeveniment,
            'data' => $this->data,
            'localitzacio' => $this->localitzacio,
            'zona' => $this->zona,
            'pagament' => $this->pagament,
            'esdeveniment_id' => $this->esdeveniment_id,
            'data_id' => $this->data_id,
            'loc_id' => $this->loc_id,
            'zona_id' => $this->zona_id,
            'pagament_id' => $this->pagament_id,
        ];
    }
    
}
