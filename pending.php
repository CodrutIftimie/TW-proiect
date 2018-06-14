<?php
@session_start();
include "database.php";

$url = isset($_POST["code"])?$_POST["code"]:"";
if(isset($_POST["view"]))
    header("Location: product.php?code=".$url);
if(isset($_POST["approve"])) {
    $sql = "UPDATE products SET pending=0 WHERE code=".$url;
    mysqli_query($connection,$sql);
}
if(isset($_POST["deny"])) {
    $sql = "DELETE FROM products WHERE code=".$url;
    mysqli_query($connection,$sql);
}
?>

<html>
    <head>
        <title>CanF - Pending products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="images/icon.ico" rel="shortcut icon">
        <link href="css/navStyle.css" rel="stylesheet">
        <link href="css/pendingStyle.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
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
        <div id="body">
            <ul>
            <?php
                $found = 0;
                $query = 'SELECT image1,name_product,in_stock,price,product_url,code FROM products WHERE pending=1';
                $result = mysqli_query($connection, $query);
                if($result != false) {
                    while($row = mysqli_fetch_row($result)) {
                        $superVal=0;
                            if(count(explode(".",$row[3]))>1)
                                $superVal = explode(".",$row[3])[1];
                            else $superVal = 00;
                        echo '<li>
                                <img src="' . $row[0] . '" alt="Image of the product">
                                <h1>' . ($row[1]!=""?$row[1]:$row[5]) . '</h1>
                                <h2>In stock (' . $row[2] . ')</h2>
                                <h3>$' . ceil($row[3]) . '<sup>' . $superVal . '</sup></h3>
                                <form action="/pending.php" method="post">
                                    <input name="code" type="text" value="'.$row[5]. '" style="display:none">
                                    <input id="apv" name="approve"type="submit" value="&#10003;">
                                    <input id="view" name="view" type="submit" value="View">
                                    <input id="dny" name="deny" type="submit" value="&#x2717;">
                                </form>
                            </li>';
                        $found = $found + 1;
                    }
                }
                if($found == 0)
                    echo "<p align=\"center\">There are no pending items!</p>";
            ?>
        </ul>
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