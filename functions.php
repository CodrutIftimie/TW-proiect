<?php

    function loggedin() {
        if (isset($_SESSION['loggedUser']) || isset($_COOKIE['loggedUser']))
            //$loggedIn = TRUE;
            return TRUE;
    }

?>