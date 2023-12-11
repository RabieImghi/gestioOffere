<?php
require_once "Connection.php";
class User extends Connection {

    public function Registre($name,$email,$password,$passwordConfirm,$roleuserID){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (username,email,passwordHash,roleuserID) VALUES (?,?,?,?)");
        if( $password==$passwordConfirm){
            $newPassHash=MD5($password);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $newPassHash);
            $stmt->bindParam(4, $roleuserID);
            $result=$stmt->execute();
            if($result) return true;
        }
    }
    public function Login($email,$password){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND passwordHash=?");
        $newPassHash=MD5($password);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $newPassHash);
        $result=$stmt->execute();
        $numRows = $stmt->rowCount();
        if($result && $numRows>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }
}