<?php

class Contact  {
    
    private $nom;
    private $cognom;
    private $mail;
    private $missatge;
    private $data;
    
    public function __construct($nom, $cognom, $mail, $missatge, $data){
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->mail = $mail;
        $this->missatge = $missatge;
        $this->data = $data;
    }
}