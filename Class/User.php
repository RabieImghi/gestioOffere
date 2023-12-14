<?php
require_once "Connection.php";
class User extends Connection {
    public static function Registre($name,$email,$password,$passwordConfirm,$roleuserID){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("INSERT INTO users (username,email,passwordHash,roleuserID) VALUES (?,?,?,?)");
        if( $password==$passwordConfirm){
            $newPassHash=MD5($password);
            $stmt->bindParam(1,$name);
            $stmt->bindParam(2,$email);
            $stmt->bindParam(3,$newPassHash);
            $stmt->bindParam(4,$roleuserID);
            $result=$stmt->execute();
            if($result) return true;
        }
    }
    public static function Login($email,$password){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("SELECT * FROM users WHERE email=? AND passwordHash=?");
        $newPassHash=MD5($password);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$newPassHash);
        $result=$stmt->execute();
        $numRows = $stmt->rowCount();
        if($result && $numRows>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }
    public static function GetUsers(){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function UpdateUser($name,$email,$roleuserID,$id_user){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("UPDATE users SET username=?, email=?, roleuserID=? WHERE userID =?");
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$email);
        $stmt->bindParam(3,$roleuserID);
        $stmt->bindParam(4,$id_user);
        $result=$stmt->execute();
        if($result) return true;
    }
    public static function DeletUser($id_user){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("DELETE FROM users WHERE userID =?");
        $stmt->bindParam(1,$id_user);
        $result=$stmt->execute();
        if($result) return true;
    }
}