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
}