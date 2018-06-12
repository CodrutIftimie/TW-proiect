<?php
    if ( ! session_id() ) @ session_start();
    include "database.php";
    include "Classes.php";

    $linkBuilder = new LinkBuilder();
    $parameters = $_SERVER['QUERY_STRING'];
    $paramArray = explode("&",$parameters);

    foreach($paramArray as $param) {
        if(count(explode("=",$param))>1)
            $linkBuilder->append(new LinkParameter(explode("=",$param)[0],explode("=",$param)[1]));
    }

    $ingredients = 0;
    $sqlIngredients = "";
    if(sizeof($linkBuilder->getArrayValues("i"))) {
        foreach($linkBuilder->getArrayValues("i") as $x) {
            if($ingredients > 0) {
                $sqlIngredients = $sqlIngredients . " OR ingredients LIKE '%" . getFullValue($x) . "%'";
            }
            else $sqlIngredients = " AND (ingredients LIKE '%" . getFullValue($x) . "%'";
            $ingredients++;
        }
        $sqlIngredients = $sqlIngredients . ')';
    }

    $packages = 0;
    $sqlPackages = "";
    if(sizeof($linkBuilder->getArrayValues("p"))) {
        foreach($linkBuilder->getArrayValues("p") as $x) {
            if($packages > 0) {
                $sqlPackages = $sqlPackages . " OR packages LIKE '%" . getFullValue($x) . "%'";
            }
            else $sqlPackages = " AND (packages LIKE '%" . getFullValue($x) . "%'";
            $packages++;
        }
        $sqlPackages = $sqlPackages . ')';
    }

    $MoC = 0;
    $sqlMoC = "";
    if(sizeof($linkBuilder->getArrayValues("m"))) {
        foreach($linkBuilder->getArrayValues("m") as $x) {
            if($MoC > 0) {
                $sqlMoC = $sqlMoC . " OR moc LIKE '%" . getFullValue($x) . "%'";
            }
            else $sqlMoC = " AND (moc LIKE '%" . getFullValue($x) . "%'";
            $MoC++;
        }
        $sqlMoC = $sqlMoC . ')';
    }

    $page  = $linkBuilder->getArgumentValue("page")==""?1:$linkBuilder->getArgumentValue("page");
    $title = $linkBuilder->getArgumentValue("search");
    $order = $linkBuilder->getArgumentValue("order")==""?1:$linkBuilder->getArgumentValue("order");
    $minPrice = $linkBuilder->getArgumentValue("pmin")==""?0:$linkBuilder->getArgumentValue("pmin");
    $maxPrice = $linkBuilder->getArgumentValue("pmax")==""?999999:$linkBuilder->getArgumentValue("pmax");

    $sqlPrice = " AND price BETWEEN " . $minPrice . " AND " . $maxPrice;

    switch($order) {
        case 1 : $order = "created_t DESC"; break;
        case 2 : $order = "created_t ASC"; break;
        case 3 : $order = "product_name ASC"; break;
        case 4 : $order = "product_name DESC"; break;
        default: $order = "created_t DESC"; break;
    }

    function setLink($pagen) {
        global $linkBuilder;
        $copy = clone $linkBuilder;
        $copy->modifyArgument("page",$pagen);
        return "list.php" . $copy->toString();
    }

?>

<html>

<head>
    <title>CanF - Products List</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="images/icon.ico" rel="shortcut icon">
    <link href="css/navStyle.css" rel="stylesheet">
    <link href="css/listStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montseratt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Farsan" rel="stylesheet">

    <script>
    String.prototype.replaceAt = function(index, replacement) {
        return this.substr(0, index) + replacement + this.substr(index + replacement.length);
    }
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

    function changeOrder() {
        var url = window.location.href;
        var val = document.getElementById("order").value;

        if(url.indexOf("&order=") != -1)
            url = url.replaceAt(url.indexOf("&order=")+7,val);
        else if(url.indexOf("?order=") != -1)
            url = url.replaceAt(url.indexOf("?order=")+7,val);
        else if(url.indexOf("?") != -1)
            url = url + "&order=" + val;
        else url = url + "?order=" + val;
        window.location.assign(url);
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
            <form action="/list.php" method="get">
                <div class="price">
                    <h5>Price</h5>
                    <input name="pmin" type="number" placeholder="min">
                    <input name="pmax" type="number" placeholder="max">
                </div>
                <div>
                    <h5>Ingredients</h5>
                    <input type="checkbox" name="i[]" value="h2o" id="water">
                    <label for="water">Water</label>
                    <br>
                    <input type="checkbox" name="i[]" value="tmt" id="tomatoes">
                    <label for="tomatoes">Tomatoes</label>
                    <br>
                    <input type="checkbox" name="i[]" value="veg" id="vegetables">
                    <label for="vegetables">Vegetables</label>
                    <br>
                    <input type="checkbox" name="i[]" value="meat" id="meat">
                    <label for="meat">Meat</label>
                    <br>
                    <input type="checkbox" name="i[]" value="fish" id="fish">
                    <label for="fish">Fish</label>
                    <br>
                    <input type="checkbox" name="i[]" value="chs" id="cheese">
                    <label for="cheese">Cheese</label>
                    <br>
                    <input type="checkbox" name="i[]" value="frt" id="fruits">
                    <label for="fruits">Fruits</label>
                    <br>
                </div>
                <div>
                    <h5>Package</h5>
                    <input type="checkbox" name="p[]" value="cbb" id="cardboard">
                    <label for="cardboard">Cardboard Box</label>
                    <br>
                    <input type="checkbox" name="p[]" value="mtb" id="metal">
                    <label for="metal">Metal Box</label>
                    <br>
                    <input type="checkbox" name="p[]" value="pb" id="plastic">
                    <label for="plastic">Plastic Box</label>
                    <br>
                    <input type="checkbox" name="p[]" value="jar" id="jar">
                    <label for="jar">Jar</label>
                    <br>
                    <input type="checkbox" name="p[]" value="btl" id="bottle">
                    <label for="bottle">Bottle</label>
                    <br>
                    <input type="checkbox" name="p[]" value="csr" id="casserole">
                    <label for="casserole">Casserole</label>
                    <br>
                    <input type="checkbox" name="p[]" value="env" id="envelope">
                    <label for="envelope">Envelope</label>
                    <br>
                    <input type="text" id="otherPackage" placeholder="Type another package type">
                    <br>
                </div>
                <div>
                    <h5>Means of cooking</h5>
                    <input type="checkbox" name="m[]" value="mcv" id="microwave">
                    <label for="microwave">Microwave</label>
                    <br>
                    <input type="checkbox" name="m[]" value="gsc" id="gascooker">
                    <label for="gascooker">Gas Cooker</label>
                    <br>
                    <input type="checkbox" name="m[]" value="bld" id="blender">
                    <label for="blender">Blender</label>
                    <br>
                </div>
                <input type="submit" value="Set" />
            </form>
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
                    $found = 0;
                    $query = 'SELECT image_url,product_name,10,19,99,url,code FROM products_test 
                              WHERE LOWER(product_name) LIKE \'%' . strtolower($title) . '%\'' .$sqlIngredients. '' .$sqlPackages. '' .$sqlMoC. ' ORDER BY ' . $order;
                    $queryFinal = $query . ' LIMIT ' . (($page-1)*16) . ',16';
                    $result = mysqli_query($connection, $queryFinal);
                    if($result != false) {
                        while($row = mysqli_fetch_row($result)) {
                            echo '<li>
                                    <img src="' . $row[0] . '" alt="images/missing.png">
                                    <h1>' . ($row[1]!=""?$row[1]:$row[6]) . '</h1>
                                    <h2>In stock (' . $row[2] . ')</h2>
                                    <h3>$' . $row[3] . '<sup>' . $row[4] . '</sup></h3>
                                    <form action="' . $row[5] . '"><input type="submit" value="Details"></form>
                                </li>';
                            $found = $found + 1;
                        }
                    }
                    if($found == 0)
                        echo "<p align=\"center\">There is no item that matches your specifications!</p>";
                ?>
            </ul>
            <div id="pageSelect">
                <?php
                    if($found != 0) {
                        if($page>1)
                            echo '<a href="' . setLink($page-1) . '" target="_self">Previous</a>';
                        $numrows = "SELECT FLOOR(COUNT(*)/16)+2 FROM (" . $query . ") as t";
                        $row = mysqli_fetch_row(mysqli_query($connection, $numrows));

                        if($page != 1) 
                            echo '<a href="' . setLink(1) . '" target="_self">1</a>';
                        else 
                            echo '<a href="' . setLink(1) . '" class="active" target="_self">1</a>';

                        if($page-3>0)
                            echo '...';

                        for($i=2;$i<$row[0]-1;$i++) {
                            if($i+1 == $page && $i!=1)
                                echo '<a href="' . setLink($i) . '" target="_self">' . $i . '</a>';
                            else if($i == $page)
                                echo '<a href="' . setLink($i) . '" class="active" target="_self">' . $i . '</a>';
                            else if($i-1 == $page && $i!=$row[0]-1)
                                echo '<a href="' . setLink($i) . '" target="_self">' . $i . '</a>';
                        }

                        if($page+2<$row[0]-1)
                            echo '...';
                        if($page != $row[0]-1) 
                            echo '<a href="' . setLink(($row[0]-1)) . '" target="_self">' .($row[0]-1). '</a>';
                        else if($page!=1)
                            echo '<a href="' . setLink(($row[0]-1)) . '" class="active" target="_self">' .($row[0]-1). '</a>';

                        if($page<$row[0]-1)
                            echo '<a href="' . setLink($page+1) . '" target="_self">Next</a>';
                    }
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