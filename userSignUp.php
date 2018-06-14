<?php
    session_start();

    include "database.php";

    if (isset($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else die();
    if (isset($_POST['sname'])) {
        $sname = $_POST['sname'];
    } else die();
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }  else die();
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }  else die();
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else die();
    if (isset($_POST['numar'])) {
        $numar = $_POST['numar'];
    } else die();

    $verifyUser = "SELECT * FROM users WHERE user_username = '$username'";
    $resultUser = mysqli_query($connection,$verifyUser);
    $countUser = mysqli_num_rows($resultUser);

    $verifyEmail = "SELECT * FROM users WHERE user_email = '$email'";
    $resultEmail = mysqli_query($connection,$verifyEmail);
    $countEmail = mysqli_num_rows($resultEmail);

    if ($countUser < 1 && $countEmail < 1) {
        $sql = "INSERT INTO users (user_fname, user_sname, user_username, user_passw, user_email, user_phonenr) 
                        VALUES ('$fname', '$sname', '$username', '$password', '$email', '$numar')";
        $result = mysqli_query($connection, $sql);

        header("Location: loggedIndex.php");
    }
    else if ($countUser > 0) {
        $message = "User already in use, press ok to try again.";
        echo "<script type='text/javascript'>alert('$message');window.close();</script>";
        echo "<script>setTimeout(\"location.href = 'SignUp.php';\",1);</script>";
    }
    else if ($countEmail > 0) {
        $message = "Email already in use, press ok to try again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>setTimeout(\"location.href = 'SignUp.php';\",1);</script>";
    }
?>