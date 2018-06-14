<?php
    session_start();
    include "database.php";
    include 'functions.php';

    if(loggedin()) {
        if (isset($_COOKIE['loggedUser'])){
            if($_COOKIE['loggedUser'] == "AdelinPamint" || $_COOKIE['loggedUser'] == "CodrutIftimie" || $_COOKIE['loggedUser'] == "LeonardPester" ) header("Location:adminMails.php");
        }
        if (isset($_SESSION['loggedUser'])){
            if($_SESSION['loggedUser'] == "AdelinPamint" || $_SESSION['loggedUser'] == "CodrutIftimie" || $_SESSION['loggedUser'] == "LeonardPester" ) header("Location:adminMails.php");
        }
    }
?>


<!DOCTYPE html>
<html>

<head>
    <title>CanF Contact</title>

    <link href="images/icon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
    <link rel="stylesheet" href="css/contactStyle.css">
    <link href="css/navStyle.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <div id="top">
        <div id="topMenu">
            <div id="siteName">
                <?php
                    if(loggedin()){
                        echo '<a href="loggedIndex.php">
                        <img id="logo" src="images/logo.png">
                        <p id="siteNameText">
                            CanF
                        </p>
                    </a>';
                    } else {
                        echo '<a href="index.php">
                        <img id="logo" src="images/logo.png">
                        <p id="siteNameText">
                            CanF
                        </p>
                    </a>';
                    }
                ?>
            </div>
        </div>
        <form id="search">
            <?php
                $holder = "&#x1F50E; Search for a product...";
                echo '<input id="searchbar" type="text" placeholder="' . $holder . '" onkeypress="search(event)">';
            ?>
        </form>
        <?php
            if(loggedin()){
                echo '<div id="navMenu">
                <div id="menubutton"></div>
                <a href="loggedIndex.php">
                    <button type="button">Home</button>
                </a>
                <a href="list.php">
                    <button type="button">Products</button>
                </a>
                <a class="active" href="contact.php">
                    <button type="button">Contact</button>
                </a>
                <a href="profile.php">
                    <button type="button">Profile</button>
                </a>
            </div>';
            } else {
                echo '<div id="navMenu">
                <div id="menubutton"></div>
                <a href="index.php">
                    <button type="button">Home</button>
                </a>
                <a class="active" href="list.php">
                    <button type="button">Products</button>
                </a>
                <a class="active" href="contact.php">
                    <button type="button">Contact</button>
                </a>
            </div>';
            }
        ?>
    </div>

    <div id="logSignButt">
        <?php
            if(loggedin()){
                echo '<a href="userLogOut.php">
                    <button type="button">Log out</button>
                    </a>';
            } else {
                echo '<a href="SignUp.php">
                    <button type="button">LogIn/SignUp</button>
                    </a>';
            }
        ?>
    </div>

    <div id="both">

        <div id="leftBox">
            <form action="sendMail.php" method="POST">
                <div class="row">
                    <h3>We are all ears</h3>
                </div>

                <div class="row">
                    <input type="text" id="name" name="fname" placeholder="Your name" required pattern="[A-Za-z' -]+">
                    <input type="email" id="name" name="userMail" placeholder="Your e-mail" required>
                </div>

                <div class="row">
                    <input type="email" id="mail" name="email" placeholder="Staff's e-mail" required>
                </div>

                <div class="row">
                    <input type="number" id="nr" name="numar" min="0000000000" max="9999999999" placeholder="Phone number" required>
                </div>

                <div class="row">
                    <textarea maxlength="1000" type="subject" name="subject" placeholder="Your message goes here" required></textarea>
                </div>

                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

        <div id="rightBox">
            <div class="row">
                <h2>The team</h2>
            </div>

            <div class="row">
                <h3>Adelin</h3>
                <div class="rowtext">
                    <p>0765432189</p>
                    <p>adelin@gmail.com</p>
                </div>
            </div>

            <div class="row">
                <h3>Codrut</h3>
                <div class="rowtext">
                    <p>0765432189</p>
                    <p>codrut@gmail.com</p>
                </div>
            </div>

            <div class="row">
                <h3>Leonard</h3>
                <div class="rowtext">
                    <p>0765432189</p>
                    <p>leonard@gmail.com</p>
                </div>
            </div>
        </div>

    </div>

    <div id="footer">

        <div id="contact">
            <h5 class="head">Contact</h5>
            <p>0764 646 646</p>
            <a class="footerA" href="contact.php">
                <p>Write to us</p>
            </a>
        </div>

        <div id="account">
            <h5 class="head">Account</h5>
            <a class="footerA" href="SignUp.php">
                <p>Create Account</p>
            </a>
            <a class="footerA" href="profile.php">
                <p>My Account</p>
            </a>
        </div>

    </div>

</body>

</html>