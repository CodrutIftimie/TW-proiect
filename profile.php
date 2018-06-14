<?php
    @session_start();
    include "database.php";
    include "functions.php";

    $visiting = 0;
    if(!isset($_COOKIE["loggedUser"]))
            header("Location: /SignUp.php");
    if(isset($_GET["username"])) {
        $sql = "SELECT count(user_id), user_fname, user_sname, user_email, user_phonenr, user_rank FROM users WHERE user_username LIKE BINARY '". $_GET["username"] . "';";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_row($result);
        if($row[0] == 1) {
            $userName = $_GET["username"];
            $foreName = $row[1];
            $surName = $row[2];
            $email = $row[3];
            $phone = $row[4];
            $rank = $row[5];
            $visiting = 1;
        }
        else header("Location: /SignUp.php");
    }
    else {
        $sql = "SELECT user_fname, user_sname, user_email, user_phonenr, user_rank FROM users WHERE user_username LIKE BINARY '". $_COOKIE["loggedUser"] . "';";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_row($result);
        $userName = $_COOKIE["loggedUser"];
        $foreName = $row[0];
        $surName = $row[1];
        $email = $row[2];
        $phone = $row[3];
        $rank = $row[4];
        $page = 1;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>CanF - Profile</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="images/icon.ico" rel="shortcut icon">
    <link href="css/navStyle.css" rel="stylesheet">
    <link href="css/profileStyle.css" rel="stylesheet">
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
                $holder = "&#x1F50E; Search for a product...";
                echo '<input id="searchbar" type="text" placeholder="' . $holder . '" onkeypress="search(event)">';
            ?>
        </form>
        <div id="navMenu">
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
            <a href="list.php">
                <button type="button">Products</button>
            </a>
            <a href="contact.php">
                <button type="button">Contact</button>
            </a>
        </div>
    </div>
    <div id="body">
    <?php
    if($visiting == 0)
        echo '<div id="navigation">';
    else echo '<div id="navigationb">';
    ?>
            <div id="info">
                <?php
                    echo "<p id=\"user\">" . $userName . "</p>";
                    echo "<p id=\"name\">". $foreName . " " . $surName . "</p>";
                    echo "<p id=\"uemail\">" . $email . "</p>";
                ?>
            </div>
            <?php
                if($visiting == 0)
                    echo '<form action="form.php">';
                else echo '<form action="form.php" style="display:none">';
                echo '<button>Add a product</button>
                      </form>';
            
                if($rank > 0 && $visiting == 0)
                    echo '<form action="/pending.php">';
                else echo '<form action="/pending.php" style="display:none">';
                echo "<button>Pending products</button>";
                echo "</form>";

                if($visiting == 0)
                    echo '<form action="exportAsPDF.php" target="_blank">';
                else echo '<form action="exportAsPDF.php" target="_blank" style="display:none">';
                echo '<button>Stock Information</button>
                      </form>';

                if($visiting == 0)
                    echo '<form action="export_csv.php">';
                else echo '<form action="export_csv.php" style="display:none">';
                echo '<button>Export CSV</button>
                    </form>';

                if($visiting == 0)
                    echo '<form action="export_xml.php">';
                else echo '<form action="export_xml.php" style="display:none">';
                echo '<button>Export XML</button>
                    </form>';
            
                if($visiting == 0)
                    echo '<form action="#editprofile">';
                else echo '<form action="#editprofile" style="display:none">';
                echo '<button>Edit Name</button>
                      </form>';

                if($visiting == 0)
                    echo '<form action="#editprofile">';
                else echo '<form action="#editprofile" style="display:none">';
                 echo '<button>Edit Email</button>
                       </form>';

                if($visiting == 0)
                    echo '<form action="#editprofile">';
                else echo '<form action="#editprofile" style="display:none">';
                echo '<button>Edit Phone Number</button>
                      </form>';

                if($visiting == 0)
                    echo '<form action="#editprofile">';
                else echo '<form action="#editprofile" style="display:none">';
                echo '<button>Edit Password</button>
                      </form>';
            ?>
        </div>
        <?php
        if($visiting == 0)
            echo '<div id="content">';
        else echo '<div id="contentb">';
        ?>
            <div class="break">
                <p>Products added</p>
            </div>
            <div id="added">
                <?php
                    $productNo = 0;
                    $sql = "SELECT name_product, product_url, image1 FROM products WHERE creator='".$userName."'";
                    $result = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_row($result)) {
                        if($productNo < 9)
                            echo '<a href="' . $row[1] . '" class="addedproduct">';
                        else echo '<a href="' . $row[1] . '" style="display:none" class="addedproduct">';
                             echo '<div class="product">
                                    <img src="'. $row[2] . '" alt="Image of the product">
                                    <p class="title">'. $row[0] . '</p>
                                </div>
                              </a>';
                        $productNo++;
                    }
                ?>
                <div id="pageSelect">
                    <input type="button" value="Previous" onclick="previousElements()" />
                    <input type="button" value="Next" onclick="nextElements()" />
                </div>
            </div>
            <?php

            if($visiting == 0 && $rank > 0)
                echo '<div class="break" id="import">';
            else echo '<div class="break" id="import" style="display:none">';
                echo '<p>Import CSV | XML</p>
                      </div>';

            if($visiting == 0 && $rank > 0) {
                echo '<form action="import.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" value="upload">
                    <input type="submit" value="Import">
                     </form>';
            }

            if($visiting == 0)
                echo '<div class="break" id="editprofile">';
            else echo '<div class="break" id="editprofile" style="display:none">';
            echo '<p>Edit Profile</p>
                  </div>';

            if($visiting == 0)
                echo '<form id="profileInfo" action="updateUser.php" method="post">';
            else echo '<form id="profileInfo" style="display:none" action="profile.php" method="post">';
            ?>
                <div id="firstName" class="profileDiv">
                <label for="fnameinput">First Name</label>
                    <?php echo '<input name="firstname" id="fnameinput" type="text" placeholder="' .$foreName. '">'; ?>
                </div>
                <div id="lastName" class="profileDiv">
                    <label for="lnameinput">Last Name</label>
                    <?php echo '<input name="lastname" id="lnameinput" type="text" placeholder="' .$surName. '">'; ?>
                </div>
                <div id="email" class="profileDiv">
                    <label for="emailinput">Email</label>
                    <?php echo '<input name="email" id="emailinput" type="email" placeholder="' .$email. '">'; ?>
                </div>
                <div id="phone" class="profileDiv">
                    <label for="phoneinput">Phone number</label>
                    <?php echo '<input name="phonenr" id="phoneinput" type="number" placeholder="0' .$phone. '">'; ?>
                </div>
                <div id="password" class="profileDiv">
                    <label for="password1">New Password&nbsp;</label>
                    <input name="password" id="password1" class="profileDiv" type="password" />
                    <br>
                    <label for="cpassword">Confirm Password</label>
                    <input name="passwordc" id="cpassword" class="profileDiv" type="password" />
                </div>
                <input id="save" type="submit" value="Save changes" />
            </form>
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
    <script>

    var added = document.getElementsByClassName("addedproduct");
    var pageNo = 1;
    var onLastPageShown = added.length%9==0?9:added.length%9;

    function nextElements() {
        if(added.length/9 <= pageNo)
            alert("No more products to show!");
        else {
            pageNo++;
            var newHidden = 0;
            var newShown = 0;
            for(var index=0; index < added.length; index++) {
                if(added[index].style.display != "none" && newHidden < 9) {
                    added[index].style.display = "none";
                    newHidden++;
                }
                else if(newHidden == 9 && newShown < 9){
                    added[index].style.display = "";
                    newShown++;
                }
            }
        }
    }

    function previousElements() {
        if(pageNo == 1)
            alert("No more products to show!");
        else if(pageNo < added.length/9) {
            pageNo--;
            var newHidden = 0;
            var newShown = 0;
            for(var index=added.length-1; index >= 0; index--) {
                if(added[index].style.display != "none" && newHidden < 9) {
                    added[index].style.display = "none";
                    newHidden++;
                }
                else if(newHidden == 9 && newShown < 9){
                    added[index].style.display = "";
                    newShown++;
                }
            }
        }
        else if(pageNo == Math.ceil(added.length/9)) {
            pageNo--;
            var newHidden = 0;
            var newShown = 0;
            for(var index=added.length-1; index >= 0; index--) {
                if(added[index].style.display != "none" && onLastPageShown - newHidden > 0) {
                    added[index].style.display = "none";
                    newHidden++;
                }
                else if(onLastPageShown - newHidden == 0 && newShown < 9){
                    added[index].style.display = "";
                    newShown++;
                }
            }
        }
    }
    </script>
</body>

</html>