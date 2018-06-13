<?php
@session_start();
include "database.php";

$url = isset($_POST["link"])?$_POST["link"]:"";
if(isset($_POST["view"]))
    header("Location: ".$url);
?>

<html>
    <head>
        <title>CanF - Pending products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="images/icon.ico" rel="shortcut icon">
        <link href="css/navStyle.css" rel="stylesheet">
        <link href="css/pendingStyle.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
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
                <a href="index.html">
                    <button type="button">Home</button>
                </a>
                <a href="list.html">
                    <button type="button">Products</button>
                </a>
                <a href="contact.html">
                    <button type="button">Contact</button>
                </a>
            </div>
        </div>
        <div id="body">
            <ul>
            <?php
                $found = 0;
                $query = 'SELECT image_url,product_name,10,19,99,url,code FROM products_test';
                $result = mysqli_query($connection, $query);
                if($result != false) {
                    while($row = mysqli_fetch_row($result)) {
                        echo '<li>
                                <img src="' . $row[0] . '" alt="images/missing.png">
                                <h1>' . ($row[1]!=""?$row[1]:$row[6]) . '</h1>
                                <h2>In stock (' . $row[2] . ')</h2>
                                <h3>$' . $row[3] . '<sup>' . $row[4] . '</sup></h3>
                                <form action="/pending.php" method="post">
                                    <input name="link" type="text" value="'.$row[5]. '" style="display:none">
                                    <input id="apv" name="approve"type="submit" value="&#10003;">
                                    <input id="view" name="view" type="submit" value="View">
                                    <input id="dny" name="deny" type="submit" value="&#x2717;">
                                </form>
                            </li>';
                        $found = $found + 1;
                    }
                }
                if($found == 0)
                    echo "<p align=\"center\">There is no pending item!</p>";
            ?>
        </ul>
        </div>
    </body>
</html>