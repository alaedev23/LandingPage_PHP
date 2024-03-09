<?php

class User {
    
    public $id;
    public $email;
    public $password;
    public $tipusIdent;
    public $numeroIdent;
    public $nom;
    public $cognoms;
    public $sexe;
    public $naixement;
    public $adreca;
    public $codiPostal;
    public $poblacio;
    public $provincia;
    public $telefon;
    public $imatge;
    public $status;
    public $navegador;
    public $plataforma;
    public $dataCreacio;
    public $dataDarrerAcces;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getTipusIdent()
    {
        return $this->tipusIdent;
    }

    /**
     * @return mixed
     */
    public function getNumeroIdent()
    {
        return $this->numeroIdent;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @return mixed
     */
    public function getNaixement()
    {
        return $this->naixement;
    }

    /**
     * @return mixed
     */
    public function getAdreca()
    {
        return $this->adreca;
    }

    /**
     * @return mixed
     */
    public function getCodiPostal()
    {
        return $this->codiPostal;
    }

    /**
     * @return mixed
     */
    public function getPoblacio()
    {
        return $this->poblacio;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @return mixed
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @return mixed
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getNavegador()
    {
        return $this->navegador;
    }

    /**
     * @return mixed
     */
    public function getPlataforma()
    {
        return $this->plataforma;
    }

    /**
     * @return mixed
     */
    public function getDataCreacio()
    {
        return $this->dataCreacio;
    }

    /**
     * @return mixed
     */
    public function getDataDarrerAcces()
    {
        return $this->dataDarrerAcces;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $tipusIdent
     */
    public function setTipusIdent($tipusIdent)
    {
        $this->tipusIdent = $tipusIdent;
    }

    /**
     * @param mixed $numeroIdent
     */
    public function setNumeroIdent($numeroIdent)
    {
        $this->numeroIdent = $numeroIdent;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $cognoms
     */
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @param mixed $naixement
     */
    public function setNaixement($naixement)
    {
        $this->naixement = $naixement;
    }

    /**
     * @param mixed $adreca
     */
    public function setAdreca($adreca)
    {
        $this->adreca = $adreca;
    }

    /**
     * @param mixed $codiPostal
     */
    public function setCodiPostal($codiPostal)
    {
        $this->codiPostal = $codiPostal;
    }

    /**
     * @param mixed $poblacio
     */
    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @param mixed $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @param mixed $imatge
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $navegador
     */
    public function setNavegador($navegador)
    {
        $this->navegador = $navegador;
    }

    /**
     * @param mixed $plataforma
     */
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;
    }

    /**
     * @param mixed $dataCreacio
     */
    public function setDataCreacio($dataCreacio)
    {
        $this->dataCreacio = $dataCreacio;
    }

    /**
     * @param mixed $dataDarrerAcces
     */
    public function setDataDarrerAcces($dataDarrerAcces)
    {
        $this->dataDarrerAcces = $dataDarrerAcces;
    }

    public function __construct($id, $email, $password, $tipusIdent="", $numeroIdent="", $nom="", $cognoms="", $naixement="", $sexe="", $imatge="", $dataCreacio="", $dataDarrerAcces="", $adreca="", $codiPostal="", $poblacio="", $provincia="", $telefon="", $status="", $navegador="", $plataforma="") {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->tipusIdent = $tipusIdent;
        $this->numeroIdent = $numeroIdent;
        $this->nom = $nom;
        $this->cognoms = $cognoms;
        $this->sexe = $sexe;
        $this->naixement = $naixement;
        $this->adreca = $adreca;
        $this->codiPostal = $codiPostal;
        $this->poblacio = $poblacio;
        $this->provincia = $provincia;
        $this->telefon = $telefon;
        $this->imatge = $imatge;
        $this->status = $status;
        $this->navegador = $navegador;
        $this->plataforma = $plataforma;
        $this->dataCreacio = $dataCreacio;
        $this->dataDarrerAcces = $dataDarrerAcces;
    }
    
    
}