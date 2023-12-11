<?php
session_start();
require_once "../Class/User.php";
if(isset($_POST["registre"])){
    extract($_POST);
    $roleuserID=2;
    $user = new User();
    $result=$user->Registre($name,$email,$password,$passwordConfirm,$roleuserID);
    if($result) header('location:../login.php');
}
if(isset($_POST["login"])){
    extract($_POST);
    $user = new User();
    $result=$user->Login($email,$password);
    $_SESSION['roleUser']=$result['roleuserID'];
    if($_SESSION['roleUser']==1) header("location: ../dashboard/dashboard.php");
    if($_SESSION['roleUser']==2) header("location: ../index.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php");
}
