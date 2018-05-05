<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "", "canf");
?>

<!DOCTYPE html>
<html>

<head>
    <title>CanF SignUp/LogIn</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/icon.ico" rel="shortcut icon">
    <link href="css/signUpStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
    <link href="css/navStyle.css" rel="stylesheet">
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

    <div id="total">
        <div id="sign">
            <h1>
                SIGN UP FORM
            </h1>

            <div id="logBox">
                <form action = "userSignUp.php" method = "POST">

                    <div class="main">
                        <div class="leftText">
                            <label for="name">Name:</label>
                        </div>
                        <div class="rightText">
                            <input type="text" id="name" name="fname" placeholder="First name" required>
                            <input type="text" id="name" name="sname" placeholder="Last name" required>
                        </div>
                    </div>

                    <div class="main">
                        <div class="leftText">
                            <label for="user">Username:</label>
                        </div>
                        <div class="rightText">
                            <input type="text" id="user" name="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="main">
                        <div class="leftText">
                            <label for="pass">Password:</label>
                        </div>
                        <div class="rightText">
                            <input type="password" id="pass" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="main">
                        <div class="leftText">
                            <label for="mail">E-mail:</label>
                        </div>
                        <div class="rightText">
                            <input type="email" id="mail" name="email" placeholder="E-mail" required>
                        </div>
                    </div>

                    <div class="main">
                        <div class="leftText">
                            <label for="nr">Phone number:</label>
                        </div>
                        <div class="rightText">
                            <input type="number" id="nr" name="numar" min="0000000000" max="9999999999" placeholder="Phone number" required>
                        </div>
                    </div>

                    <div class="main">
                        <input type="submit" value="Submit">
                    </div>

                </form>
            </div>
        </div>

        <div id="log">
            <div id="main">
                <div id="title">
                    <h2>
                        Log In
                    </h2>
                </div>
                <div id="logBox">
                    <form>
                        <h3>Username:</h3>
                        <input type="text" placeholder="Username">
                        <h3>Password:</h3>
                        <input type="password" placeholder="Password">
                        <h3>Glad to have you back</h3>
                        <input type="submit" value="Log In">
                    </form>
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