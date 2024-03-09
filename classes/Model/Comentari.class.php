<?php

class Comentari {
    private $data;
    private $nombre;
    private $email;
    private $valoracion;
    private $mensaje;
    

    public function __construct($nombre, $email, $valoracion, $mensaje, $data=null) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->valoracion = $valoracion;
        $this->mensaje = $mensaje;
        $this->data = ($data==null) ? date("Y-m-d") : $data;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($param) {
        $this->nombre = $param;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($param) {
        $this->email = $param;
    }
    public function getMensaje() {
        return $this->mensaje;
    }
    public function setMensaje($param) {
        $this->mensaje = $param;
    }
    public function getValoracion() {
        return $this->valoracion;
    }
    public function setValoracion($param) {
        $this->valoracion = $param;
    }
    public function getData() {
        return $this->data;
    }
    public function setData($param) {
        $this->data = $param;
    }
   
}

?>

