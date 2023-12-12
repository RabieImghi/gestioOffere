<?php
require_once "Connection.php";
class ApplyOnline extends Connection {
    public function applyOffre($idJob,$idUser){
        $conection = new Connection();
        $conn = $conection->getConnection();
        $stmt = $conn->prepare("SELECT * FROM applyonline WHERE userID=? AND jobID =? ");
        $stmt->bindParam(1, $idUser);
        $stmt->bindParam(2, $idJob);
        $stmt->execute();
        $numRows = $stmt->rowCount();
        if($numRows==0) {
            $status=0;
            $stmt2=$conn->prepare("INSERT INTO applyonline (userID,jobID,Status) VALUE (?,?,?)");
            $stmt2->bindParam(1,$idUser);
            $stmt2->bindParam(2,$idJob);
            $stmt2->bindParam(3,$status);
            $result=$stmt2->execute();
            if($result) return true;
            else return false;
        }
        else return false;
    }
}