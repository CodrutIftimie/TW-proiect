<?php
    $server   = "localhost";
    $username = "site";
    $password = "a1b2c3d4e5f6";
    $database = "website";

    $connection = mysqli_connect($server,$username,$password,$database);

    if(!$connection) {
        die("Could not connect to the database! " . mysqli_connect_error());
    }
?>