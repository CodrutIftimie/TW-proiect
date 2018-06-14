<?php

    session_start();

    session_destroy();

    setcookie("loggedUser", "", time()-7200);

    header("Location: index.php");

?>