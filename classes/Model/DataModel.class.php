<?php

class DataModel {

    private $conn;

    public function __construct() {
        $this->conn = $this->connection();
    }
    
    private function connection($type = "select") {
        return new DataBase($type);
    }

    public function create(Data $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_data (id, data, hora) VALUES (?, ?, ?)",
            [$obj->id, $obj->data, $obj->hora]);
    }

    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_data");

        $dates = [];
        foreach ($consulta as $row) {
            $data = new Data();
            $data->id = $row['id'];
            $data->data = $row['data'];
            $data->hora = $row['hora'];
            $dates[] = $data;
        }

        return $dates;
    }

    public function getById(Data $obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_data WHERE id = ?", [$obj->id]);

        if (count($consulta) > 0) {
            $row = $consulta[0];
            $data = new Data();
            $data->id = $row['id'];
            $data->data = $row['data'];
            $data->hora = $row['hora'];
            return $data;
        }

        return null;
    }

    public function update(Data $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_data SET data = ?, hora = ? WHERE id = ?",
            [$obj->data, $obj->hora, $obj->id]);
    }

    public function delete(Data $obj) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_data WHERE id = ?", [$obj->id]);
    }
}
