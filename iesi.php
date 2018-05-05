<?php

    include 'functions.php';

    if (isset($_COOKIE['loggedUser']))
        {echo "cookie";
        echo $_COOKIE['loggedUser'];}

    if (isset($_SESSION['loggedUser']))
    {echo "session";
        echo $_SESSION['loggedUser'];}

    if (isset($_COOKIE['loggedUser']))
    {echo "cookie";
        echo $_COOKIE['loggedUser'];}

    if (!loggedin()) {
        header("Location: SignUp.php");
    }

?>

<p>You are logged in.</p> <br/> <br/>
<a href="userLogOut.php">Log out</a>