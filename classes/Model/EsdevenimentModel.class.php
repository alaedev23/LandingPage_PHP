<?php
    
class EsdevenimentModel {
    
    private $conn;
    
    public function __construct() {
        $this->conn = $this->connection();
    }
    
    public function connection($type = "select") {
        return new DataBase($type);
    }
    
    public function create(Esdeveniment $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_usuaris (id, titol, subtitol, dates, imatge) VALUES (?, ?, ?, ?, ?)",
            [$obj->id, $obj->titol, $obj->subtitol, $obj->dates, $obj->imatge]);
    }
    
    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_esdeveniment");
        
        $esdeveniments = [];
        foreach ($consulta as $row) {
            $esdeveniment = new Esdeveniment();
            $esdeveniment->id = $row['id'];
            $esdeveniment->titol = $row['titol'];
            $esdeveniment->subtitol = $row['subtitol'];
            $esdeveniment->dates = $row['dates'];
            $esdeveniment->imatge = $row['imatge'];
            $esdeveniments[] = $esdeveniment;
        }
        
        return $esdeveniments;
    }
    
    public function getById(Esdeveniment $obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_esdeveniment WHERE id = ?", [$obj->id]);
        
        if (count($consulta) > 0) {
            $row = $consulta[0];
            $esdeveniment = new Esdeveniment();
            $esdeveniment->id = $row['id'];
            $esdeveniment->titol = $row['titol'];
            $esdeveniment->subtitol = $row['subtitol'];
            $esdeveniment->dates = $row['dates'];
            $esdeveniment->imatge = $row['imatge'];
            return $esdeveniment;
        }
        
        return null;
    }
    
    public function update(Esdeveniment $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_esdeveniment SET titol = ?, subtitol = ?, dates = ?, imatge = ? WHERE id = ?",
            [$obj->titol, $obj->subtitol, $obj->dates, $obj->imatge, $obj->id]);
    }
    
    public function delete(Esdeveniment $obj) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_esdeveniment WHERE id = ?", [$obj->id]);
    }
    
}
