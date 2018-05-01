<?php
session_start();
include "database.php";
if(!isset($_SESSION["activePageNumber"])) {
    $_SESSION["activePageNumber"] = 1;
}
?>

<html>

<head>
    <title>CanF - Products List</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="images/icon.ico" rel="shortcut icon">
    <link href="css/navStyle.css" rel="stylesheet">
    <link href="css/listStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin|Pacifico|Mina:700|Inconsolata|Montseratt|Farsan" rel="stylesheet">
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
    <div id="body">
        <div id="filters">
            <h6>Filter by...</h6>
            <div class="price">
                <h5>Price</h5>
                <input type="number" placeholder="min">
                <input type="number" placeholder="max">

            </div>
            <div>
                <h5>Ingredients</h5>
                <input type="checkbox" value="Tomatoes" id="tomatoes">
                <label for="tomatoes">Tomatoes</label>
                <br>
                <input type="checkbox" value="Vegetables" id="vegetables">
                <label for="vegetables">Vegetables</label>
                <br>
                <input type="checkbox" value="Meat" id="meat">
                <label for="meat">Meat</label>
                <br>
                <input type="checkbox" value="Fish" id="fish">
                <label for="fish">Fish</label>
                <br>
                <input type="checkbox" value="Cheese" id="cheese">
                <label for="cheese">Cheese</label>
                <br>
                <input type="checkbox" value="Fruits" id="fruits">
                <label for="fruits">Fruits</label>
                <br>
            </div>
            <div>
                <h5>Package</h5>
                <input type="checkbox" value="Tomatoes" id="cardboard">
                <label for="cardboard">Cardboard Box</label>
                <br>
                <input type="checkbox" value="Vegetables" id="metal">
                <label for="metal">Metal Box</label>
                <br>
                <input type="checkbox" value="Meat" id="plastic">
                <label for="plastic">Plastic Box</label>
                <br>
                <input type="checkbox" value="Fish" id="jar">
                <label for="jar">Jar</label>
                <br>
                <input type="checkbox" value="Cheese" id="bottle">
                <label for="bottle">Bottle</label>
                <br>
                <input type="checkbox" value="Fruits" id="casserole">
                <label for="casserole">Casserole</label>
                <br>
                <input type="checkbox" value="Fruits" id="envelope">
                <label for="envelope">Envelope</label>
                <br>
            </div>
            <div>
                <h5>Means of cooking</h5>
                <input type="checkbox" value="Fruits" id="microwave">
                <label for="microwave">Microwave</label>
                <br>
                <input type="checkbox" value="Fruits" id="gascooker">
                <label for="gascooker">Gas Cooker</label>
                <br>
                <input type="checkbox" value="Fruits" id="blender">
                <label for="blender">Blender</label>
                <br>
            </div>
        </div>
        <div id="items">
            <h6>Sort by</h6>
            <select>
                <option>Newest</option>
                <option>Price ascending</option>
                <option>Price descending</option>
                <option>Name A - Z</option>
                <option>Name Z - A</option>
            </select>
            <ul>
                <?php
                    $query = "SELECT image,title,in_stock,FLOOR(price),SUBSTRING_INDEX(price,'.',-1),link FROM products LIMIT 16";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_row($result)) {
                        echo '<li>
                                <img src="' . $row[0] . '">
                                <h1>' . $row[1] . '</h1>
                                <h2>In stock (' . $row[2] . ')</h2>
                                <h3>$' . $row[3] . '<sup>' . $row[4] . '</sup></h3>
                                <form action="' . $row[5] . '"><input type="submit" value="Details"></form>
                            </li>';
                    }
                ?>
            </ul>
            <div id="pageSelect">
                <a href="#">Previous</a>
                <?php
                    $query = "SELECT FLOOR(COUNT(*)/16)+2 FROM products ORDER BY created_at DESC";
                    $row = mysqli_fetch_row(mysqli_query($connection, $query));
                    for($i=1;$i<$row[0];$i++) {
                        if($i != $_SESSION["activePageNumber"]) {
                            echo '<a href="#">' . $i . '</a>';
                        }
                        else {
                            echo '<a href="#" class="active">' . $i . '</a>';
                        }
                    }
                ?>
                <a href="#">Next</a>
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