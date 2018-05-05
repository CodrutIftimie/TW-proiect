<?php
    $connection = mysqli_connect("localhost", "root", "", "canf");
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
</head>

<body>

    <div id="top">
        <div id="topMenu">
            <div id="siteName">
                <a href="index.html">
                    <img id="logo" src="images/logo.png">
                    <p id="siteNameText">
                        CanF
                    </p>
                </a>
            </div>
        </div>
        <div id="search">
            <input type="text" placeholder="&#x1F50E; Search for a product...">
        </div>
        <div id="navMenu">
            <div id="menubutton"></div>
            <a href="index.html">
                <button type="button">Home</button>
            </a>
            <a class="active" href="list.html">
                <button type="button">Products</button>
            </a>
            <a href="contact.html">
                <button type="button">Contact</button>
            </a>
        </div>
    </div>

    <div id="logSignButt">
        <a href="SignUp.html">
            <button type="button">LogIn/SignUp</button>
        </a>
    </div>

    <div id="both">

        <div id="leftBox">
            <form action="sendMail.php" method="POST">
                <div class="row">
                    <h3>We are all ears</h3>
                </div>

                <div class="row">
                    <input type="text" id="name" name="fname" placeholder="First name" required>
                    <input type="text" id="name" name="sname" placeholder="Last name" required>
                </div>

                <div class="row">
                    <input type="email" id="mail" name="email" placeholder="E-mail" required>
                </div>

                <div class="row">
                    <input type="number" id="nr" name="numar" min="0000000000" max="9999999999" placeholder="Phone number" required>
                </div>

                <div class="row">
                    <textarea type="subject" name="subject" placeholder="Your message goes here" required></textarea>
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
            <p>support@CanF.com</p>
            <a class="footerA" href="contact.html">
                <p>Write to us</p>
            </a>
        </div>

        <!-- <div id="help">
            <h5 class="head">Help Center</h5>
            <a class="footerA" href="#">
                <p>FAQ</p>
            </a>
            <a class="footerA" href="#">
                <p>Terms&Conditions</p>
            </a>
        </div> -->

        <div id="account">
            <h5 class="head">Account</h5>
            <a class="footerA" href="SignUp.html">
                <p>Create Account</p>
            </a>
            <a class="footerA" href="#">
                <p>My Account</p>
            </a>
        </div>

    </div>

</body>

</html>