<?php

class PagamentModel {
    
    private $conn;
    
    public function __construct() {
        $this->conn = $this->connection();
    }
    
    public function connection($type = "select") {
        return new DataBase($type);
    }
    
    public function create(Pagament $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_pagament (id, banc, ref_externa, data, estat) VALUES (?, ?, ?, ?, ?)",
            [$obj->id, $obj->banc, $obj->ref_externa, $obj->data, $obj->estat]);
    }
    
    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_pagament");
        
        $pagaments = [];
        foreach ($consulta as $row) {
            $pagament = new Pagament();
            $pagament->id = $row['id'];
            $pagament->banc = $row['banc'];
            $pagament->ref_externa = $row['ref_externa'];
            $pagament->data = $row['data'];
            $pagament->estat = $row['estat'];
            $pagaments[] = $pagament;
        }
        
        return $pagaments;
    }
    
    public function getById(Pagament $obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_pagament WHERE id = ?", [$obj->id]);
        
        if (count($consulta) > 0) {
            $row = $consulta[0];
            $pagament = new Pagament();
            $pagament->id = $row['id'];
            $pagament->banc = $row['banc'];
            $pagament->ref_externa = $row['ref_externa'];
            $pagament->data = $row['data'];
            $pagament->estat = $row['estat'];
            return $pagament;
        }
        
        return null;
    }
    
    public function update(Pagament $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_pagament SET banc = ?, ref_externa = ?, data = ?, estat = ? WHERE id = ?",
            [$obj->banc, $obj->ref_externa, $obj->data, $obj->estat, $obj->id]);
    }
    
    public function delete(Pagament $obj) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_pagament WHERE id = ?", [$obj->id]);
    }
}
