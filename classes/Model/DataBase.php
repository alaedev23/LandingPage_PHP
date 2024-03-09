<?php

class DataBase extends Singleton {
    
    private $link;
    private $conexion;
    
    public function __construct($tipoConsulta) {
        parent::__construct();
        $this->conexion = new Connexio($tipoConsulta);
        switch ($this->conexion->getSgbd()) {
            case 'mysql' :
                if ($link = new mysqli($this->conexion->getHost(), $this->conexion->getUsuario(), $this->conexion->getPassword(), $this->conexion->getBase())){
                    $this->link = $link;
                } else {
                    throw new Exception("No s'ha conectat");
                }
                break;
            case 'pgsql' :
                break;
            case 'oracle' :
                break;
            case 'mongodb' :
                break;
        }
    }
    
    public function __destruct() {
        $this->link->close();
    }
    
    public function executarSQL($sSql, $aParam = null) {
        if ($stmt = $this->link->prepare($sSql)) {
            if (!empty($aParam)) {
                $types = str_repeat('s', count($aParam));
                $stmt->bind_param($types, ...$aParam);
            }
            if ($stmt->execute()) {
                $res = $stmt->get_result();
                if ($res !== false) {
                    $dades = $res->fetch_all(MYSQLI_ASSOC);
                } else {
                    $dades = "La consulta se ha realizado con existo";
                }
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }
        }
        return $dades;
    }
    
    public function changeUser($us, $ct) {
        $this->link->change_user($us, $ct, $this->base);
    }
    
    public function getLink() {
        return $this->link;
    }
    
}

?>