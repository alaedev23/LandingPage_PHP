<?php

class MyPDO {
    
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection;

    public function __construct() {
        $this->host = 'localhost';
        $this->dbname = 'myweb';
        $this->username = 'usr_generic';
        $this->password = '2024@Thos';

        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            throw new Exception("Error a la conexio a la BD: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->connection;
    }
    
    public function fetchObject($statement, $className) {
        $stmt = $this->connection->query($statement);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
    }
    
}

?>
