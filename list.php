<?php
    session_start();
    include "database.php";
    include "Classes.php";
    include "functions.php";

    $linkBuilder = new LinkBuilder();
    $parameters = $_SERVER['QUERY_STRING'];
    $paramArray = explode("&",$parameters);

    foreach($paramArray as $param) {
        if(count(explode("=",$param))>1)
            $linkBuilder->append(new LinkParameter(explode("=",$param)[0],explode("=",$param)[1]));
    }

    $ingredients = 0;
    $sqlIngredients = "";
    foreach($linkBuilder->getArrayValues(1) as $x) {
        if($ingredients > 0) {
            $sqlIngredients = $sqlIngredients . " OR ingredients LIKE '%" .getFullValue($x). "%'";
        }
        else $sqlIngredients = " AND (ingredients LIKE '%" . getFullValue($x) . "%'";
        $ingredients++;
    }
    $sqlIngredients = ($sqlIngredients!=""?$sqlIngredients.')':"");

    $otherPackage = isset($_GET["otherPackage"])?$_GET["otherPackage"]:"";

    $packages = 0;
    $sqlPackages = $otherPackage!=""?(" AND (packages LIKE '%".$otherPackage."%'"):"";
    $packages = $sqlPackages!=""?1:0;
    foreach($linkBuilder->getArrayValues(2) as $y) {
        if($packages > 0) {
            $sqlPackages = $sqlPackages . " OR packages LIKE '%" . getFullValue($y) . "%'";
        }
        else $sqlPackages = " AND (packages LIKE '%" . getFullValue($y) . "%'";
        $packages++;
    }
    $sqlPackages = ($sqlPackages!=""?$sqlPackages.')':"");

    $MoC = 0;
    $sqlMoC = "";
    foreach($linkBuilder->getArrayValues(3) as $z) {
        if($MoC > 0) {
            $sqlMoC = $sqlMoC . " OR moc LIKE '%" . getFullValue($z) . "%'";
        }
        else $sqlMoC = " AND (moc LIKE '%" . getFullValue($z) . "%'";
        $MoC++;
    }
    $sqlMoC = ($sqlMoC!=""?$sqlMoC.')':"");

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
            <?php
                if(loggedin())
                    echo '<a href="loggedIndex.php">
                    <img id="logo" src="images/logo.png">
                        <p id="siteNameText">
                            CanF
                        </p>
                    </a>';
                else
                    echo '<a href="index.php">
                        <img id="logo" src="images/logo.png">
                            <p id="siteNameText">
                                CanF
                            </p>
                        </a>';
                
            ?>
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
                <?php
                if(loggedin())
                    echo '<a href="loggedIndex.php">
                    <button type="button">Home</button>
                    </a>';
                else
                    echo '<a href="index.php">
                    <button type="button">Home</button>
                    </a>';
                
                ?>
            <a class="active" href="list.php">
                <button type="button">Products</button>
            </a>
            <a href="contact.php">
                <button type="button">Contact</button>
            </a>
            <?php
            if(loggedin()){
                echo '
                <a href="profile.php">
                    <button type="button">Profile</button>
                </a>';
            }
            ?>
        </div>
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
    <div id="body">
        <div id="filters">
            <h6>Filter by...</h6>
            <form action="/list.php" method="get">
                <div class="price">
                    <h5>Price</h5>
                    <input name="pmin" type="number" placeholder="min" <?php if($minPrice > 0) echo 'value='.$minPrice;?>>
                    <input name="pmax" type="number" placeholder="max" <?php if($maxPrice < 999999) echo 'value='.$maxPrice;?>>
                </div>
                <div>
                    <h5>Ingredients</h5>
                    <br>
                    <input type="checkbox" name="ig[]" value="tmt" id="tomatoes" <?php if(in_array("tmt",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="tomatoes">Tomatoes</label>
                    <br>
                    <input type="checkbox" name="ig[]" value="veg" id="vegetables" <?php if(in_array("veg",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="vegetables">Vegetables</label>
                    <br>
                    <input type="checkbox" name="ig[]" value="meat" id="meat" <?php if(in_array("meat",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="meat">Meat</label>
                    <br>
                    <input type="checkbox" name="ig[]" value="fish" id="fish" <?php if(in_array("fish",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="fish">Fish</label>
                    <br>
                    <input type="checkbox" name="ig[]" value="chs" id="cheese" <?php if(in_array("chs",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="cheese">Cheese</label>
                    <br>
                    <input type="checkbox" name="ig[]" value="frt" id="fruits" <?php if(in_array("frt",$linkBuilder->getArrayValues(1))) echo 'checked="checked"';?>>
                    <label for="fruits">Fruits</label>
                    <br>
                </div>
                <div>
                    <h5>Package</h5>
                    <input type="checkbox" name="pk[]" value="cbb" id="cardboard" <?php if(in_array("cbb",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="cardboard">Cardboard Box</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="mtb" id="metal" <?php if(in_array("mtb",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="metal">Metal Box</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="pb" id="plastic" <?php if(in_array("pb",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="plastic">Plastic Box</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="jar" id="jar" <?php if(in_array("jar",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="jar">Jar</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="btl" id="bottle" <?php if(in_array("btl",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="bottle">Bottle</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="csr" id="casserole" <?php if(in_array("csr",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="casserole">Casserole</label>
                    <br>
                    <input type="checkbox" name="pk[]" value="env" id="envelope" <?php if(in_array("env",$linkBuilder->getArrayValues(2))) echo 'checked="checked"';?>>
                    <label for="envelope">Envelope</label>
                    <br>
                    <input name="otherPackage" type="text" id="otherPackage" placeholder="Type another package type" <?php if($otherPackage!="") echo 'value='.$otherPackage; ?>>
                    <br>
                </div>
                <div>
                    <h5>Means of cooking</h5>
                    <input type="checkbox" name="mc[]" value="mcv" id="microwave" <?php if(in_array("mcv",$linkBuilder->getArrayValues(3))) echo 'checked="checked"';?>>
                    <label for="microwave">Microwave</label>
                    <br>
                    <input type="checkbox" name="mc[]" value="gsc" id="gascooker" <?php if(in_array("gsc",$linkBuilder->getArrayValues(3))) echo 'checked="checked"';?>>
                    <label for="gascooker">Gas Cooker</label>
                    <br>
                    <input type="checkbox" name="mc[]" value="bld" id="blender" <?php if(in_array("bld",$linkBuilder->getArrayValues(3))) echo 'checked="checked"';?>>
                    <label for="blender">Blender</label>
                    <br><br>
                    <input type="submit" value="Set" id="filterSubmit" />
                </div>
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
                    $query = 'SELECT image1,name_product,in_stock,price,product_url,code FROM products 
                              WHERE LOWER(name_product) LIKE \'%' . strtolower($title) . '%\'' .$sqlIngredients. '' .$sqlPackages. '' .$sqlMoC. ' AND pending=0 ORDER BY ' . $order;
                    $queryFinal = $query . ' LIMIT ' . (($page-1)*16) . ',16';
                    $result = mysqli_query($connection, $queryFinal);
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
                                    <form action="product.php"><input type="submit" value="Details"><input type="text" name="code" value="'.$row[5].'" style="display:none"></form>
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