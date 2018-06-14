<?php
    session_start();

    include "database.php";

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }  else die();
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }  else die();
    if (isset($_POST['rememberme'])) {
        $rememberme = $_POST['rememberme'];
    }


    $login = "SELECT * FROM users WHERE user_username = '$username' AND user_passw = '$password'";
    $resultLogin = mysqli_query($connection,$login);

    if (!$row = mysqli_fetch_assoc($resultLogin)) {
        $message = "Incorrect user/password, press ok to try again.";
        echo "<script type='text/javascript'>alert('$message');window.close();</script>";
        echo "<script>setTimeout(\"location.href = 'SignUp.php';\",1);</script>";
    }
    else {
        if ($rememberme == "on")
            setcookie("loggedUser", $username, time()+7200);
        else
            if($rememberme == "") {
                $_SESSION['loggedUser'] = $username;
                setcookie("loggedUser", $username, time()+2000);
            }
        
        if ($username == "AlexPopa")
            header("Location: adminMails.php");
        else
            header("Location: loggedIndex.php");
    }

?>