<?php

class ZonaModel {
    
    private $conn;
    
    public function __construct() {
        $this->conn = $this->connection();
    }
    
    public function connection($type = "select") {
        return new DataBase($type);
    }
    
    public function create(Zona $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_zona (id, descripcio) VALUES (?, ?)",
            [$obj->id, $obj->descripcio]);
    }
    
    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_zona");
        
        $zonas = [];
        foreach ($consulta as $row) {
            $zona = new Zona();
            $zona->id = $row['id'];
            $zona->descripcio = $row['descripcio'];
            $zonas[] = $zona;
        }
        
        return $zonas;
    }
    
    public function getById(Zona $obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_zona WHERE id = ?", [$obj->id]);
        
        if (count($consulta) > 0) {
            $row = $consulta[0];
            $zona = new Zona();
            $zona->id = $row['id'];
            $zona->descripcio = $row['descripcio'];
            return $zona;
        }
        
        return null;
    }
    
    public function update(Zona $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_zona SET descripcio = ? WHERE id = ?",
            [$obj->descripcio, $obj->id]);
    }
    
    public function delete(Zona $obj) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_zona WHERE id = ?", [$obj->id]);
    }
}
