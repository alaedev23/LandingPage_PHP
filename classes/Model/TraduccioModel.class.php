<?php

class TraduccioModel {
    
    private $lang;
    private $pdo;
    
    public function __construct()
    {
        $this->pdo = new MyPDO();
    }
    
    public function read()
    {
        $query = "SELECT * FROM tbl_traduccions";
        $stmt = $this->pdo->getPdo()->query($query);
        
        $traduccions = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $traduccio = new Traduccio();
            foreach ($row as $key => $value) {
                if ($key !== 'created_at' && $key !== 'updated_at') {
                    $traduccio->$key = $value;
                }
            }
            $traduccions[] = $traduccio;
        }
        
        return $traduccions;
    }
    
    public function create(Traduccio $obj)
    {
        $query = "INSERT INTO tbl_traduccions (variable, idioma_id, valor)
                  VALUES (:variable, :idioma_id, :valor)";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':variable', $obj->variable);
        $stmt->bindParam(':idioma_id', $obj->idioma_id);
        $stmt->bindParam(':valor', $obj->valor);
        
        $stmt->execute();
    }
    
    public function update(Traduccio $obj)
    {
        $query = "UPDATE tbl_traduccions
                  SET variable = :variable, idioma_id = :idioma_id, valor = :valor
                  WHERE id = :id";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':id', $obj->id);
        $stmt->bindParam(':variable', $obj->variable);
        $stmt->bindParam(':idioma_id', $obj->idioma_id);
        $stmt->bindParam(':valor', $obj->valor);
        
        $stmt->execute();
    }
    
    public function delete(Traduccio $obj)
    {
        $query = "DELETE FROM tbl_traduccions WHERE idioma_id = :idioma_id";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':idioma_id', $obj->idioma_id);
        
        $stmt->execute();
    }    
    
    public function getByLanguageIdiomaId($idioma_id)
    {
        
        $query = "SELECT * FROM tbl_traduccions WHERE idioma_id = :idioma_id";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':idioma_id', $idioma_id);
        $stmt->execute();
        
        $traduccions = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $traduccio = new Traduccio();
            foreach ($row as $key => $value) {
                if ($key !== 'created_at' && $key !== 'updated_at') {
                    $traduccio->$key = $value;
                }
            }
            $traduccions[] = $traduccio;
        }
        
        return $traduccions;
    }
    
    
    public function getByLanguageVariable($variable)
    {
        
        $query = "SELECT * FROM tbl_traduccions WHERE variable = :variable";
        
        $stmt = $this->pdo->getPdo()->prepare($query);
        
        $stmt->bindParam(':variable', $variable);
        $stmt->execute();
        
        $traduccions = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $traduccio = new Traduccio();
            foreach ($row as $key => $value) {
                if ($key !== 'created_at' && $key !== 'updated_at') {
                    $traduccio->$key = $value;
                }
            }
            $traduccions[] = $traduccio;
        }
        
        return $traduccions;
    }
}

?>
