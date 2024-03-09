<?php

class LocalitzacioModel {
    
    private $conn;
    
    public function __construct() {
        $this->conn = $this->connection();
    }
    
    public function connection($type = "select") {
        return new DataBase($type);
    }
    
    public function create(Localitzacio $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_localitzacio (id, lloc, adreca, localitat) VALUES (?, ?, ?, ?)",
            [$obj->id, $obj->lloc, $obj->adreca, $obj->localitat]);
    }
    
    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_localitzacio");
        
        $localitzacions = [];
        foreach ($consulta as $row) {
            $localitzacio = new Localitzacio();
            $localitzacio->id = $row['id'];
            $localitzacio->lloc = $row['lloc'];
            $localitzacio->adreca = $row['adreca'];
            $localitzacio->localitat = $row['localitat'];
            $localitzacions[] = $localitzacio;
        }
        
        return $localitzacions;
    }
    
    public function getById($obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_localitzacio WHERE id = ?", [$obj->id]);
        
        if (count($consulta) > 0) {
            $row = $consulta[0];
            $localitzacio = new Localitzacio();
            $localitzacio->id = $row['id'];
            $localitzacio->lloc = $row['lloc'];
            $localitzacio->adreca = $row['adreca'];
            $localitzacio->localitat = $row['localitat'];
            return $localitzacio;
        }
        
        return null;
    }
    
    public function update(Localitzacio $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_localitzacio SET lloc = ?, adreca = ?, localitat = ? WHERE id = ?",
            [$obj->lloc, $obj->adreca, $obj->localitat, $obj->id]);
    }
    
    public function delete($id) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_localitzacio WHERE id = ?", [$id]);
    }
}
