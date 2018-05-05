<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "", "canf");

    if (!$connection) {
        die("Connection failed");
    }

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
        echo "Wrong :(";
    }
    else {
        if ($rememberme == "on")
            setcookie("loggedUser", $username, time()+7200);
        else
            if($rememberme == "")
                $_SESSION['loggedUser'] = $username;
        
        header("Location: iesi.php");
    }

    // if ($countUser < 1 && $countEmail < 1) {
    //     $sql = "INSERT INTO users (user_fname, user_sname, user_username, user_passw, user_email, user_phonenr) 
    //                     VALUES ('$fname', '$sname', '$username', '$password', '$email', '$numar')";
    //     $result = mysqli_query($connection, $sql);

    //     header("Location: index.html");
    // }
    // else if ($countUser > 0) {
    //     $message = "User already in use, press ok to try again.";
    //     echo "<script type='text/javascript'>alert('$message');</script>";
    //     //echo "<script>setTimeout(\"location.href = 'SignUp.php';\",1);</script>";
    //     sleep(2);
    //     echo "<script type='text/javascript'>alert('$message');</script>";
    //     header("Location: SignUp.php");
    // }
    // else if ($countEmail > 0) {
    //     $message = "Email already in use, press ok to try again.";
    //     echo "<script type='text/javascript'>alert('$message');</script>";
    //     echo "<script>setTimeout(\"location.href = 'SignUp.php';\",1);</script>";
    // }
?>