<?php
require_once "Connection.php";
require_once "Job.php";
class ApplyOnline {
    public static function applyOffre($idJob,$idUser){
        $conn = Connection::getConnection();
        $stmt = $conn->prepare("SELECT * FROM applyonline WHERE userID=? AND jobID =?");
        $stmt->bindParam(1, $idUser);
        $stmt->bindParam(2, $idJob);
        $stmt->execute();
        $numRows = $stmt->rowCount();
        if($numRows==0) {
            $status=0;
            $stmt2=$conn->prepare("INSERT INTO applyonline (userID,jobID,Status,notification) VALUE (?,?,?,?)");
            $notification=0;
            $stmt2->bindParam(1,$idUser);
            $stmt2->bindParam(2,$idJob);
            $stmt2->bindParam(3,$status);
            $stmt2->bindParam(4,$notification);
            $result=$stmt2->execute();
            if($result) return true;
            else return false;
        }
        else return false;
    }
    public static function getApplyOnline($isAprouve){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("SELECT * FROM users NATURAL JOIN applyonline NATURAL JOIN jobs WHERE Status=?");
        $stmt->bindParam(1,$isAprouve);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public static function AprouvOffer($idOffer,$test){
        $conn = Connection::getConnection();
        if($test==1){
            $stmt=$conn->prepare("UPDATE applyonline SET Status=?, notification	=? WHERE ApplyOnlineID=?");
            $notification=1;
            $status=1;
            $stmt->execute([$status,$notification,$idOffer]);
    
            $stmt2=$conn->prepare("SELECT * FROM applyonline WHERE ApplyOnlineID =?");
            $stmt2->execute([$idOffer]);
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            
            $aprouves=new Job();
            $idJob=$result2[0]['jobID'];
            $result=$aprouves->updateAprouve($idJob,1);
        }else{
            $stmt=$conn->prepare("DELETE  FROM applyonline WHERE ApplyOnlineID=?");
            $stmt->execute([$idOffer]);
        }
        return true;
    }
    public static function DeclineOffer($idOffer){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("UPDATE applyonline SET Status=?, notification	=? WHERE ApplyOnlineID=?");
        $notification=1;
        $status=2;
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$notification);
        $stmt->bindParam(3,$idOffer);
        $result=$stmt->execute();
        if($result) return true;
    }
    public static function getNotefication($idUser){
        $conn = Connection::getConnection();
        $stmt=$conn->prepare("SELECT * FROM users NATURAL JOIN applyonline NATURAL JOIN jobs WHERE userID =?");
        $stmt->execute([$idUser]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}