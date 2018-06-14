<?php
session_start();
include "database.php";

if(!isset($_COOKIE["loggedUser"]))
    header("Location: /SignUp.php");

$values=0;

$newFirstName = isset($_POST["firstname"])?$_POST["firstname"]:"";
$newLastName = isset($_POST["lastname"])?$_POST["lastname"]:"";
$newEmail = isset($_POST["email"])?$_POST["email"]:"";
$newPhoneNumber = isset($_POST["phonenr"])?$_POST["phonenr"]:"";

$newPassword = isset($_POST["password"])?$_POST["password"]:"";
$passwordConfirm = isset($_POST["passwordc"])?$_POST["passwordc"]:"";

$fValSet = false;
$sql = "UPDATE users SET";

if($newFirstName!="")
    if($fValSet==false) {
        $sql = $sql . " user_fname='" . $newFirstName . "'";
        $fValSet = true;
    }
    else $sql = $sql . ",user_fname='" . $newFirstName . "'";
if($newLastName!="") 
    if($fValSet==false) {
        $sql = $sql . " user_sname='" . $newLastName . "'";
        $fValSet = true;
    }
    else $sql = $sql . ",user_sname='" . $newLastName . "'";
if($newEmail!="")
    if($fValSet==false) {
        $sql = $sql . " user_email='" . $newEmail . "'";
        $fValSet = true;
    }
    else $sql = $sql . ",user_email='" . $newEmail . "'";
if($newPhoneNumber!="") 
    if($fValSet==false) {
        $sql = $sql . " user_phonenr=" . $newPhoneNumber . "";
        $fValSet = true;
    }
    else $sql = $sql . ",user_phonenr=" . $newPhoneNumber . "";

if($newPassword!="") 
    if($fValSet==false) {
        $sql = $sql . " user_passw='" . $newPassword . "'";
        $fValSet = true;
    }
    else $sql = $sql . ",user_passw='" . $newPassword . "'";

if($fValSet == true) {
    if(strcmp($newPassword,$passwordConfirm)!=0)
        header("Location: /profile.php?error=pnm");
    $result = mysqli_query($connection, $sql);
    echo mysqli_error($connection);
    if($result) {
        header("Location: /profile.php?error=no");
    }
}
else header("Location: /profile.php?error=ns");
?>