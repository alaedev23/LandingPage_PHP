<?php

class UserModel implements CRUDable {
    
    private $conn;
    
    public function __construct() {
        
    }
    
    public function connection($user="usr_consulta") {
        $servername = "localhost";
        $username = $user;
        $password = "2024@Thos";
        $database = "myweb";
        
        $this->conn = new mysqli($servername, $username, $password, $database);
        
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }
    
    public function create($user) {
        
        $this->connection("usr_generic");

        $sql = "INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge, status, navegador, plataforma, dataCreacio, dataDarrerAcces)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $email = $user->getEmail();
        $password = $user->getPassword();
        $tipusIdent = $user->getTipusIdent();
        $numeroIdent = $user->getNumeroIdent();
        $nom = $user->getNom();
        $cognoms = $user->getCognoms();
        $sexe = $user->getSexe();
        $naixement = $user->getNaixement();
        $adreca = $user->getAdreca();
        $codiPostal = $user->getCodiPostal();
        $poblacio = $user->getPoblacio();
        $provincia = $user->getProvincia();
        $telefon = $user->getTelefon();
        $imatge = $user->getImatge();
        $status = $user->getStatus();
        $navegador = $user->getNavegador();
        $plataforma = $user->getPlataforma();
        $dataCreacio = $user->getDataCreacio();
        $dataDarrerAcces = $user->getDataDarrerAcces();
        
        $stmt->bind_param("sssssssssssssssisss",
            $email,
            $password,
            $tipusIdent,
            $numeroIdent,
            $nom,
            $cognoms,
            $sexe,
            $naixement,
            $adreca,
            $codiPostal,
            $poblacio,
            $provincia,
            $telefon,
            $imatge,
            $status,
            $navegador,
            $plataforma,
            $dataCreacio,
            $dataDarrerAcces
            );
        
        $stmt->execute();
        
        $stmt->close();
    }
    
    public function read($obj) {
        $this->connection();
        
        $sql = "SELECT * FROM tbl_usuaris WHERE email = ? AND password = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return null;
        }
        
        $stmt->bind_param('ss', $obj->getEmail(), $obj->getPassword());
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $stmt->close();
            
            return $row;
        }
        
        $stmt->close();
        
        return null;
    }
    
    
    public function updateDate($email) {
        $this->connection("usr_generic");
        
        $currentDateTime = date("Y-m-d H:i:s");
        
        $sql = "UPDATE tbl_usuaris SET dataDarrerAcces = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        
        $stmt->bind_param('ss', $currentDateTime, $email);
        
        $result = $stmt->execute();
        
        $stmt->close();
        
        return $result;
    }
    
    
    public function getUserByEmail($email) {
        $this->connection();
        
        $sql = "SELECT * FROM tbl_usuaris WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return null;
        }
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $stmt->close();
            return $row;
        }
        
        $stmt->close();
        
        return null;
    }
    
    
    
    public function update($email) {
        $this->connection("usr_generic");
        
        $sql = "UPDATE tbl_usuaris SET status = 1 WHERE email = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            die("Error in statement preparation: " . $this->conn->error);
        }
        
        $stmt->bind_param('s', $email);
        
        $result = $stmt->execute();
        
        if (!$result) {
            die("Error in statement execution: " . $stmt->error);
        }
        
        $stmt->close();
        
        return $result;
    }
    
    
    public function delete($obj) {}
    
}

