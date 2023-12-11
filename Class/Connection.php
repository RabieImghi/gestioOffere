<?php
class Connection{
    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=gestionoffer","root", "");
    }
    public function getConnection(){
        return $this->conn;
    }
}