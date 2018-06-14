<?php
include 'functions.php';
include "database.php";

    if (!loggedin()) {
        header("Location: SignUp.php");
    }

?>

<html>
    <style>
        body {
            background-color: #ffd966;
        }
    </style>

<head>
    <title>CanF (Canned Food Manager)</title>

    <link href="images/icon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="css/topStyle.css">
    <link href="css/navStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <script>
    function search(e){
        if(e.keyCode === 13){
            e.preventDefault();
            var searchFor = document.getElementById('searchbar').value;
            var format = /[!@#$%^&*()_+\\=\[\]{};':"\\|,.<>\/?]+/;
            if(format.test(searchFor))
                alert("You shouldn't search for something containing special characters!");
            else {

                var link="list.php?search=" + searchFor;
                window.location.assign(link);
            }
        }
    }
    </script>
</head>

<body>

<a href="index.php">
        <div id="top">
            <div id="topMenu">
                <div id="siteName">
                    <a href="loggedIndex.php">
                        <img id="logo" src="images/logo.png">
                        <p id="siteNameText">
                            CanF
                        </p>
                    </a>
                </div>
            </div>
            <form id="search">
            <?php
                $holder = "&#x1F50E; Search for a product...";
                echo '<input id="searchbar" type="text" placeholder="' . $holder . '" onkeypress="search(event)">';
            ?>
            </form>
            <div id="navMenu">
                <div id="menubutton"></div>
                <a href="loggedIndex.php">
                    <button type="button">Home</button>
                </a>
                <a href="list.php">
                    <button type="button">Products</button>
                </a>
                <a href="adminMails.php">
                                <button type="button">Contact</button>
                </a>
                
                <a href="profile.php">
                    <button type="button">Profile</button>
                </a>
            </div>
        </div>
    </a>

    <div id="logSignButt">
        <a href="userLogOut.php">
            <button type="button">Log out</button>
        </a>
    </div>

<?php

if (isset($_SESSION['loggedUser'])) {
    if ($_SESSION['loggedUser'] == "AdelinPamint") $admin = "adelin@gmail.com";
    if ($_SESSION['loggedUser'] == "CodrutIftimie") $admin = "codrut@gmail.com";
    if ($_SESSION['loggedUser'] == "LeonardPester") $admin = "leonard@gmail.com";
}
else {
    if (isset($_COOKIE['loggedUser'])) {
        if ($_COOKIE['loggedUser'] == "AdelinPamint") $admin = "adelin@gmail.com";
        if ($_COOKIE['loggedUser'] == "CodrutIftimie") $admin = "codrut@gmail.com";
        if ($_COOKIE['loggedUser'] == "LeonardPester") $admin = "leonard@gmail.com";
    }
}

$emails = "SELECT * FROM emails WHERE receiver='$admin' ORDER BY id_email DESC";

$result = mysqli_query($connection, $emails);
echo '<br>' . '<br>' . '<br>';
while($row = mysqli_fetch_row($result)) {

    echo '<div style="border: 4px solid black; width: 70%; margin-left: auto; margin-right: auto; background-color: #fff9e6; border-radius: 25px;">' . 
            '<h3 style="text-align:center; border-bottom: 2px solid #806200;">' . 'From: ' . $row[1] . ' | ' . $row[4] . '</h3>' . 
            '<div style="text-align:center; font-size: 20px; padding-bottom:10px;">' . $row[3] . '</div>'
        . '</div>' . '<br>';
        
}

?>
</body>
</html>