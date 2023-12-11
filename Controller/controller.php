<?php
session_start();
require_once "../Class/User.php";
$user = new User();
if(isset($_POST["registre"])){
    extract($_POST);
    $roleuserID=2;
    $result=$user->Registre($name,$email,$password,$passwordConfirm,$roleuserID);
    if($result) header('location:../login.php');
}
if(isset($_POST["login"])){
    extract($_POST);
    $result=$user->Login($email,$password);
    $_SESSION['roleUser']=$result['roleuserID'];
    if($_SESSION['roleUser']==1) header("location: ../dashboard/dashboard.php");
    if($_SESSION['roleUser']==2) header("location: ../index.php");
}
if(isset($_GET['deletUser'])){
    $id_user=$_GET['deletUser'];
    $result = $user->DeletUser($id_user);
    if($result) header('location:../dashboard/candidat.php');
}
if(isset($_POST['updateUser'])){
    extract($_POST);
    $result=$user->UpdateUser($name,$email,$roleuserID,$id_user);
    if($result) header('location:../dashboard/candidat.php');
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php");
}
