<?php
require_once "Connection.php";
class RoleUsers extends Connection {
    public static function GetRoles(){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("SELECT * FROM roleusers");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}