<?php
require_once "Connection.php";
class RoleUsers extends Connection {

    public function GetRoles(){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT * FROM roleusers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}