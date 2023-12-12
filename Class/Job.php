<?php
require_once "Connection.php";
class Job extends Connection {
    public function JobCout(){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as totalJobs FROM jobs");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function JobCoutActiveInactive($status){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as totalJobsActInact FROM jobs WHERE IsActive=?");
        $stmt->bindParam(1, $status);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function Jobapprove($status){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT count(*) as Jobapprove FROM jobs WHERE approve=?");
        $stmt->bindParam(1, $status);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function GetJobs(){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("SELECT * FROM jobs");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function AddJobs($title,$description,$entreprise,$location,$IsActive,$approve){
        $connection = new Connection();
        $conn=$connection->getConnection();
        $stmt = $conn->prepare("INSERT INTO jobs (title ,description, entreprise, location, IsActive, approve)
         VALUE (?,?,?,?,?,?)");
        $stmt->bindParam(1,$title);
        $stmt->bindParam(2,$description);
        $stmt->bindParam(3,$entreprise);
        $stmt->bindParam(4,$location);
        $stmt->bindParam(5,$IsActive);
        $stmt->bindParam(6,$approve);
        $result = $stmt->execute();
        if($result) return true;
    }
    public function UpdateJobs($title,$description,$entreprise,$location,$IsActive,$approve,$id_Jobs){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("UPDATE jobs SET title=?,
         description=?, entreprise=?, location=?, IsActive=?, approve=? WHERE jobID =?");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $entreprise);
        $stmt->bindParam(4, $location);
        $stmt->bindParam(5, $IsActive);
        $stmt->bindParam(6, $approve);
        $stmt->bindParam(7, $id_Jobs);
        $result=$stmt->execute();
        if($result) return true;
    }
    public function DeletJob($idJob){
        $connection = new Connection();
	    $conn = $connection->getConnection();
        $stmt = $conn->prepare("DELETE FROM jobs WHERE jobID=?");
        $stmt->bindParam(1, $idJob);
        $result=$stmt->execute();
        if($result) return true;
    }
}