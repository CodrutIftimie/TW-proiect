<?php
    session_start();
    include "database.php";
    include 'functions.php';

    if(loggedin()) {
        header("Location: loggedIndex.php");
    }

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
                <a href="index.php">
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
            <a href="index.php">
                <button type="button">Home</button>
            </a>
             <a href="list.php">
                <button type="button">Products</button>
            </a>
            <a href="contact.php">
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
                            <input type="text" id="name" name="fname" placeholder="First name" required pattern="[A-Z][A-Za-z' -]+">
                            <input type="text" id="name" name="sname" placeholder="Last name" required pattern="[A-Z][A-Za-z' -]+">
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
                    <form action = "userLogIn.php" method = "POST">
                        <h3>Username:</h3>
                        <input type="text" name="username" placeholder="Username" required>
                        <h3>Password:</h3>
                        <input type="password" name="password" placeholder="Password" required>
                        
                        <h3>Glad to have you back</h3>
                        <!-- <p>Remember me</p> -->
                        <label>Remember me</label>
                        <input type="checkbox" name="rememberme"><br/><br/>
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