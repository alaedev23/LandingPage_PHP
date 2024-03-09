<?php

class EntradaModel  {
    
    private $conn;
    
    public function __construct() {
        $this->conn = $this->connection();
    }
    
    public function connection($type = "select") {
        return new DataBase($type);
    }
    
    public function create(Entrada $obj) {
        $type = $this->connection('insert');
        $type->executarSQL("INSERT INTO tbl_entrada (esdeveniment_id, data_id, loc_id, zona_id, pagament_id, id, fila, butaca, dni) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $obj->__get('esdeveniment_id'),
                $obj->__get('data_id'),
                $obj->__get('loc_id'),
                $obj->__get('zona_id'),
                $obj->__get('pagament_id'),
                $obj->__get('id'),
                $obj->__get('fila'),
                $obj->__get('butaca'),
                $obj->__get('dni')
            ]
            );
    }
    
    
    public function read() {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_entrada");
        
        $entrades = [];
        foreach ($consulta as $row) {
            
            $entrada = new Entrada();
            $entrada->__set('esdeveniment_id',$row['esdeveniment_id']);
            $entrada->__set('data_id',$row['data_id']);
            $entrada->__set('loc_id',$row['loc_id']);
            $entrada->__set('zona_id',$row['zona_id']);
            $entrada->__set('pagament_id',$row['pagament_id']);
            $entrada->__set('id',$row['id']);
            $entrada->__set('fila',$row['fila']);
            $entrada->__set('butaca',$row['butaca']);
            $entrada->__set('dni',$row['dni']);
            
            $mEsdev = new EsdevenimentModel();
            $esd = new Esdeveniment();
            $esd->id=$entrada->esdeveniment_id;
            $entrada->esdeveniment =  $mEsdev->getById($esd);
            
            $mData = new DataModel();
            $dt = new Data();
            $dt->id = $entrada->data_id;
            $entrada->data = $mData->getById($dt);
            
            $mLoc = new LocalitzacioModel();
            $loc = new Localitzacio();
            $loc->id = $entrada->loc_id;
            $entrada->localitzacio = $mLoc->getById($loc);
            
            $mZona = new ZonaModel();
            $zn = new Zona($entrada->zona_id);
            $entrada->zona = $mZona->getById($zn);
            
            $mPagament = new PagamentModel();
            $pg = new Pagament();
            $pg->id = $entrada->pagament_id;
            $entrada->pagament = $mPagament->getById($pg);

            $entrades[] = $entrada;
        }
        
        return $entrades;
    }
    
    public function getById(Entrada $obj) {
        $type = $this->connection('select');
        $consulta = $type->executarSQL("SELECT * FROM tbl_entrada WHERE id = ?", [$obj->id]);
        
        if (count($consulta) > 0) {
            $row = $consulta[0];
            $entrada = new Entrada();
            $entrada->esdeveniment_id = $row['esdeveniment_id'];
            $entrada->data_id = $row['data_id'];
            $entrada->loc_id = $row['loc_id'];
            $entrada->zona_id = $row['zona_id'];
            $entrada->pagament_id = $row['pagament_id'];
            $entrada->id = $row['id'];
            $entrada->fila = $row['fila'];
            $entrada->butaca = $row['butaca'];
            $entrada->dni = $row['dni'];
            
            $mEsdev = new EsdevenimentModel();
            $esd = new Esdeveniment();
            $esd->id=$entrada->esdeveniment_id;
            $entrada->esdeveniment =  $mEsdev->getById($esd);
            
            $mData = new DataModel();
            $dt = new Data();
            $dt->id = $entrada->data_id;
            $entrada->data = $mData->getById($dt);
            
            $mLoc = new LocalitzacioModel();
            $loc = new Localitzacio();
            $loc->id = $entrada->loc_id;
            $entrada->localitzacio = $mLoc->getById($loc);
            
            $mZona = new ZonaModel();
            $zn = new Zona($entrada->zona_id);
            $entrada->zona = $mZona->getById($zn);
            
            $mPagament = new PagamentModel();
            $pg = new Pagament();
            $pg->id = $entrada->pagament_id;
            $entrada->pagament = $mPagament->getById($pg);
            
            return $entrada;
        }
        
        return null;
    }
    
    public function update(Entrada $obj) {
        $type = $this->connection('update');
        $type->executarSQL("UPDATE tbl_entrada SET esdeveniment_id = ?, data_id = ?, loc_id = ?, zona_id = ?, pagament_id = ?, fila = ?, butaca = ?, dni = ? WHERE id = ?",
            [
                $obj->__get('esdeveniment_id'),
                $obj->__get('data_id'),
                $obj->__get('loc_id'),
                $obj->__get('zona_id'),
                $obj->__get('pagament_id'),
                $obj->__get('fila'),
                $obj->__get('butaca'),
                $obj->__get('dni'),
                $obj->__get('id')
            ]
            );
    }
    
    public function delete($obj) {
        $type = $this->connection('delete');
        $type->executarSQL("DELETE FROM tbl_entrada WHERE id = ?", [$obj->id]);
    }
    
}

?>
