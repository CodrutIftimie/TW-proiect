<?php

    $connection = mysqli_connect("localhost", "root", "", "canf");

    if (!$connection) {
        die("Connection failed");
    }

    if (isset($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else die();
    if (isset($_POST['sname'])) {
        $sname = $_POST['sname'];
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

    $verifyEmail = "SELECT * FROM users WHERE user_email = '$email'";
    $resultEmail = mysqli_query($connection,$verifyEmail);
    $countEmail = mysqli_num_rows($resultEmail);

    if ($countEmail > 0) {
        $msg = $fname . ' ' . $sname . ' ' . '<br>' . $subject;
        echo $msg;
    }

    // faci insert la mail intr-o baza de date din care scoti continut intr-o pagina la care au acces doar admini
    // cand deschizi pagina te loghhezi si afiseaza mailurile sub forma:
    // "Mail from _ _" si sa fie href ceva sa dai click pe el si sa deschida mailul
    // ca sa afisezi faci un while fetch_assoc ceva
        //saaaau faci o tabela cu 2 chestii sau 3, mail-ul, de la cine si pentru cine si afisezi mailurile pt ala conectat si sa aiba optiunea de response and shit


    // $n = 10;
    // for($j=$n;$j>0;$j--){
    //     echo $j;
    // }
?>