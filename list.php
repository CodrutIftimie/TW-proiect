<?php
    if ( ! session_id() ) @ session_start();
    include "database.php";

    if(isset($_GET["search"])) {
        $title = $_GET["search"];
    } else $title = "";

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    } else $page = 1;

    if(isset($_GET["order"])) {
        switch($_GET["order"]) {
            case 1 : $order = "created_t DESC"; break;
            case 2 : $order = "created_t ASC"; break;
            case 3 : $order = "product_name ASC"; break;
            case 4 : $order = "product_name DESC"; break;
            default: $order = "created_t DESC"; break;
        }
    } else $order = "created_t DESC";

    function setLink($pagen) {
        $link = "";
        if(isset($_GET["search"])) {
            if(isset($_GET["order"]))
                $link = "list.php?search=" . $_GET["search"] . "&page=" . $pagen . "&order=" . $_GET["order"];
            else $link = "list.php?search=" . $_GET["search"] . "&page=" . $pagen;
        }
        else if(isset($_GET["order"]))
        $link = "list.php?page=" . $pagen . "&order=" . $_GET["order"];
        else $link = "list.php?page=" . $pagen;
        return $link;
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

    <script>
    function search(e){
        if(e.keyCode === 13){
            e.preventDefault();
            var link="list.php?search=" + document.getElementById('searchbar').value;
            window.location.assign(link);
        }
    }

    function changeOrder() {
        var url = window.location.pathname;
        var val = document.getElementById("order").value;
        if(url.indexOf("?search=") != -1)
            if(url.indexOf("&page=") != -1)
                if(url.indexOf("&order=") != -1)
                    window.location.assign(url.slice(0,-1) + val);
                else window.location.assign(url + "&order=" + val); 
            else window.location.assign(url + "&order=" + val); 
        else if(url.indexOf("?page=") != -1) 
            if(url.indexOf("&order=") != -1)
                window.location.assign(url.slice(0,-1) + val); 
            else window.location.assign(url + "&order=" + val); 
        else if(url.indexOf("?order=") != -1)
            window.location.assign(url.slice(0,-1) + val);
        else window.location.assign(url + "?order=" + val);
    }
    </script>
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
        <form id="search">
            <?php
                if($title!="") {
                    $holder = "&#x1F50E; " . $title;
                }
                else $holder = "&#x1F50E; Search for a product...";
                echo '<input id="searchbar" type="text" placeholder="' . $holder . '" onkeypress="search(event)">';
            ?>
        </form>
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
                <input type="checkbox" value="Water" id="water">
                <label for="water">Water</label>
                <br>
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
            <select id="order" onchange="changeOrder()">
                <?php 
                    echo '<option value="1" ' . ($order=="created_t DESC"?"selected":"") .'>Newest</option>';
                    echo '<option value="2" ' . ($order=="created_t ASC"?"selected":"") .'>Oldest</option>';
                    echo '<option value="3" ' . ($order=="product_name ASC"?"selected":"") .'>Name A - Z</option>';
                    echo '<option value="4" ' . ($order=="product_name DESC"?"selected":"") .'>Name Z - A</option>';
                ?>
            </select>
            <ul>
                <?php
                    $query = 'SELECT image_url,product_name,10,19,99,url,code FROM products_test WHERE LOWER(product_name) LIKE \'%' . strtolower($title) . '%\' ORDER BY ' . $order;
                    $queryFinal = $query . ' LIMIT ' . (($page-1)*16) . ',16';
                    $result = mysqli_query($connection, $queryFinal);
                    while($row = mysqli_fetch_row($result)) {
                        echo '<li>
                                <img src="' . $row[0] . '" alt="images/missing.png">
                                <h1>' . ($row[1]!=""?$row[1]:$row[6]) . '</h1>
                                <h2>In stock (' . $row[2] . ')</h2>
                                <h3>$' . $row[3] . '<sup>' . $row[4] . '</sup></h3>
                                <form action="' . $row[5] . '"><input type="submit" value="Details"></form>
                              </li>';
                    }
                ?>
            </ul>
            <div id="pageSelect">
                <?php
                    if($page>1)
                        echo '<a href="' . setLink($page-1) . '" target="_self">Previous</a>';
                    $numrows = "SELECT FLOOR(COUNT(*)/16)+2 FROM (" . $query . ") as t";
                    $row = mysqli_fetch_row(mysqli_query($connection, $numrows));
                    for($i=1;$i<$row[0];$i++) {
                        if($i != $page) {

                            echo '<a href="' . setLink($i) . '" target="_self">' . $i . '</a>';
                        }
                        else {
                            echo '<a href="' . setLink($i) . '" class="active" target="_self">' . $i . '</a>';
                        }
                    }
                    if($page<$row[0]-1)
                        echo '<a href="' . setLink($page+1) . '" target="_self">Next</a>';
                ?>
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