<?php

class IdiomaModel {
    
    private $lang;
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = new MyPDO();
    }
    
    public function read($active = false)
    {
        if ($active == true) {
            $query = "SELECT * FROM tbl_idiomes where actiu = 1";
        } else {
            $query = "SELECT * FROM tbl_idiomes";
        }
        
        $stmt = $this->pdo->getPdo()->query($query);
        
        $idiomas = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $idioma = new Idioma();
            
            foreach ($row as $key => $value) {
                $idioma->{$key} = $value;
            }
            
            $traduccioModel = new TraduccioModel();
            $idioma->traduccions = $traduccioModel->getByLanguageVariable($idioma->iso);
            
            $idiomas[] = $idioma;
        }
        
        return $idiomas;
    }
    
    
    public function getByIso(Idioma $obj)
    {
        $query = "SELECT * FROM tbl_idiomes WHERE iso = :iso";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':iso', $obj->iso);
        $stmt->execute();
        
        $idioma = $stmt->fetchObject('Idioma');
        
        if ($idioma) {
            $traduccioModel = new TraduccioModel();
            $idioma->traduccions = $traduccioModel->getByLanguageVariable($idioma->iso);
        }
        
        return $idioma;
    }
    
    public function getById(Idioma $obj)
    {
        $query = "SELECT * FROM tbl_idiomes WHERE id = :id";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':id', $obj->id);
        $stmt->execute();
        
        $idioma = $stmt->fetchObject('Idioma');
        
        if ($idioma) {
            $traduccioModel = new TraduccioModel();
            $idioma->traduccions = $traduccioModel->getByLanguageVariable($idioma->iso);
        }
        
        return $idioma;
    }
    
    public function create(Idioma $obj)
    {
        $query = "INSERT INTO tbl_idiomes (iso, imatge, actiu)
                  VALUES (:iso, :imatge, :actiu)";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':iso', $obj->iso);
        $stmt->bindParam(':imatge', $obj->imatge);
        $stmt->bindParam(':actiu', $obj->actiu);
        
        $stmt->execute();
    }
    
    public function update(Idioma $obj)
    {
        $query = "UPDATE tbl_idiomes
                  SET iso = :iso, imatge = :imatge, actiu = :actiu
                  WHERE id = :id";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':id', $obj->id);
        $stmt->bindParam(':iso', $obj->iso);
        $stmt->bindParam(':imatge', $obj->imatge);
        $stmt->bindParam(':actiu', $obj->actiu);
        
        $stmt->execute();
    }
    
    public function delete(Idioma $obj)
    {
        $query = "DELETE FROM tbl_idiomes WHERE iso = :iso";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':iso', $obj->iso);
        
        $stmt->execute();
    }
}
?>
