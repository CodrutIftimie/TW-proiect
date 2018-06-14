<?php
    session_start();
    include 'functions.php';
    include "database.php";

    if (!loggedin()) {
        header("Location: SignUp.php");
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>CanF (Canned Food Manager)</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/icon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="css/topStyle.css">
    <link href="css/navStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
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

    <a href="loggedIndex.php">
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
                <div id="menubutton"></div>
                <a class="active" href="loggedIndex.php">
                    <button type="button">Home</button>
                </a>
                <a href="list.php">
                    <button type="button">Products</button>
                </a>
                <a href="contact.php">
                    <button type="button">Contact</button>
                </a>
                <a href="profile.php">
                    <button type="button">Profile</button>
                </a>
            </div>
        </div>
    </a>

    <div id="logSignButt">
        <a href="userLogOut.php">
            <button type="button">Log out</button>
        </a>
    </div>

    <div id="middle">

        

            <div class="containerImg">
                <?php
                    $imgSQL = "SELECT image1 FROM products ORDER BY created_t DESC LIMIT 4";
                    $images = mysqli_query($connection, $imgSQL);
                    $i=0;
                    while($image = mysqli_fetch_row($images)){
                        $imageArray[$i] = $image[0];
                        $i++;
                    }
                    echo '<input type="radio" name="images" id="i1" checked>
                        <input type="radio" name="images" id="i2">
                        <input type="radio" name="images" id="i3">


                        <div class="slideImg" id="one">
                            <img src="' . $imageArray[0] . '">

                            <label for="i3" class="prev"></label>
                            <label for="i2" class="next"></label>
                        </div>

                        <div class="slideImg" id="two">
                            <img src="' . $imageArray[1] . '">

                            <label for="i1" class="prev"></label>
                            <label for="i3" class="next"></label>
                        </div>

                        <div class="slideImg" id="three">
                            <img src="' . $imageArray[2] . '">

                            <label for="i2" class="prev"></label>
                            <label for="i1" class="next"></label>
                        </div>

                        <div class="nav">
                            <label class="dots" id="dot1" for="i1"></label>
                            <label class="dots" id="dot2" for="i2"></label>
                            <label class="dots" id="dot3" for="i3"></label>
                        </div>'
                    ?>
            </div>

        

                <div id="tops">
            <div class="mostRecents scrollbar">
                <table id="tMostRecents">
                    <th scope="row" colspan=2>
                        <p id="recentsDescription">Latest products</p>
                    </th>
                    <?php
                        $sql = "SELECT name_product, image1 FROM products WHERE pending=0 ORDER BY created_t DESC LIMIT 8";
                        $result = mysqli_query($connection, $sql);
                        while ($row=mysqli_fetch_row($result)) {
                            echo '<tr>
                                    <td>
                                        <img class="recentsIcon" src="'.$row[1].'">
                                    </td>
                                    <td>
                                        <p class="recentsText">'.$row[0].'</p>
                                    </td>
                                  </tr>';

                        }
                    ?>
                </table>
            </div>
            <div class="mostRecents scrollbar">
                <table id="tMostRecents">
                    <th scope="row" colspan=2>
                        <p id="recentsDescription">Latest Comments</p>
                    </th>
                    <?php
                        $sql = "SELECT p.image1, c.com FROM products p, comments c WHERE p.code=c.id_produs and p.pending=0 ORDER BY c.created_t DESC LIMIT 8";
                        $result = mysqli_query($connection, $sql);
                        while ($row=mysqli_fetch_row($result)) {
                            echo '<tr>
                                    <td>
                                        <img class="recentsIcon" src="'.$row[0].'">
                                    </td>
                                    <td>
                                        <p class="recentsText">'.$row[1].'</p>
                                    </td>
                                  </tr>';

                        }
                    ?>
                </table>
            </div>
            
        </div>

        <div>

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