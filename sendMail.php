<?php

session_start();
include "database.php";

    if (!$connection) {
        die("Connection failed");
    }

    if (isset($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else die();
    if (isset($_POST['userMail'])) {
        $userMail = $_POST['userMail'];
    } else die();
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else die();
    if (isset($_POST['numar'])) {
        $numar = $_POST['numar'];
    } else die();
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
    } else die();


    if ($email == "adelin@gmail.com" || $email== "codrut@gmail.com" || $email == "leonard@gmail.com"){
        $data = date("d/m/y");
        $sql = "INSERT INTO emails (sender, receiver, message_sent, date_sent) 
                VALUES ('$userMail', '$email', '$subject', '$data')";
        $result = mysqli_query($connection, $sql);
        header("Location: contact.php");
    } else {
        $error = "Incorrect e-mail. Choose on of the Staff's email. Press ok to try again.";
        echo "<script type='text/javascript'>alert(\"$error\");</script>";
        echo "<script>setTimeout(\"location.href = 'contact.php';\",1);</script>";
    }

?>