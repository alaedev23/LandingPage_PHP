<?php

class Connexio extends Singleton {
    
    private $datos;
    private $sgbd;
    private $base;
    private $host;
    private $usuario;
    private $password;
    
    public function __construct($consulta) {
        include 'classes/Config/dbinfo.php';
        $this->sgbd = $sgbd;
        $this->base = $db;
        $this->host = ini_get('mysqli.default_host');
        if ($consulta === 'select') {
            $this->usuario = $user;
            $this->password = $password;
        } else {
            $this->usuario = ini_get('mysqli.default_user');
            $this->password = ini_get('mysqli.default_pw');
        }
    }
    
    public function getDatos()
    {
        return $this->datos;
    }
    
    public function getSgbd()
    {
        return $this->sgbd;
    }
    
    public function getBase()
    {
        return $this->base;
    }
    
    public function getHost()
    {
        return $this->host;
    }
    
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }
    
    public function setSgbd($sgbd)
    {
        $this->sgbd = $sgbd;
    }
    
    public function setBase($base)
    {
        $this->base = $base;
    }
    
    public function setHost($host)
    {
        $this->host = $host;
    }
    
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
}

?>