<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "website";
$conn = mysqli_connect($servername, $username, $password, $database);

if(!isset($_GET["code"]))
    header("Location: notfound.php");
else
 $code=$_GET["code"];
?>

<html>

    <head>
        <link rel="stylesheet" href="css/productStyle.css">
        <link href="css/navStyle.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:500|Permanent+Marker|Fugaz+One" rel="stylesheet">
    </head>

    <body >
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
                <input type="text" placeholder="Search for...">
            </div>
            <div id="navMenu">
                <a href="index.html">
                    <button type="button">Home</button>
                </a>
                <a href="list.html">
                    <button type="button">Products List</button>
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
        <div class="mainInf">
            <div id="font">
                <p class="fontTextNume">
                    <?php                     
                        $sql = "SELECT name_product FROM products where code=".$code.";";
                        $result = mysqli_query($conn, $sql);
                        while( $row =  mysqli_fetch_row($result)) {
                        echo $row[0];        
                    }    
                    ?>

                </p>
            </div>
            <div class="inline" id="imagine">
                 <?php       
                      $sql = "SELECT image1 FROM products where code=".$code.";";
                      $result = mysqli_query($conn, $sql);
                       while( $row =  mysqli_fetch_row($result)) 
                        echo '<img src='.$row[0].' height=100% width=100%>';
                  ?>
                
            </div>
            <div class="inline">
                <div id="infDeBaza">

                    <div class="co">
                        <b>Product characteristics</b>
                    </div>
                    <ul class="lista">
                        <li class="lista">
                        <?php  
                            $sql = "SELECT grams_100 FROM products where code=".$code.";";
                            $result = mysqli_query($conn, $sql);
                              while( $row =  mysqli_fetch_row($result)) 
                              if($row[0] != "")
                              echo "Quantity: ".$row[0];
     
                          ?>
                        </li>
                        <li class="lista"> 
                        <?php  
                            $sql = "SELECT Price FROM products where code=".$code.";";
                            $result = mysqli_query($conn, $sql);
                              while( $row =  mysqli_fetch_row($result)) 
                              if($row[0] != "")
                              echo "Price: ".$row[0];
     
                          ?>
                        </li>
                        <li class="lista"> 
                        <?php  
                            $sql = "SELECT in_stock FROM products where code=".$code.";";
                            $result = mysqli_query($conn, $sql);
                              while( $row =  mysqli_fetch_row($result)) 
                              if($row[0] != "")
                              echo "Nr. produse in stock: ".$row[0];
     
                          ?>
                        </li>
                        <li class="lista">
                        <?php  
                            $sql = "SELECT country FROM products where code=".$code.";";
                            $result = mysqli_query($conn, $sql);
                              while( $row =  mysqli_fetch_row($result)) 
                              if($row[0] != "")
                              echo "Countries where it's sold: ".$row[0];
     
                          ?>
                        </li>
                    </ul>
                </div>
                <div id="alteImagini">
                    <div style="list-style-type:none">
                        <div class="alt">
                            <div>
                            <?php       
                                 $sql = "SELECT image2 FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo '<img src='.$row[0].' height=200px width=200px>';
                             ?>       
                            </div>
                        </div>
                        <div class="alt">
                            <div>
                            <?php       
                                 $sql = "SELECT image2 FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo '<img src='.$row[0].' height=200px width=200px>';
                             ?>     
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jos" id="alteInf">
                <div class="co">
                    <b>More informations</b>
                </div>
                <div class="lista1">
                    <ul style="list-style-type:none">

                        <li class="lista1">
                            <?php                     
                                 $sql = "SELECT ingredients FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Ingredients: </b>".$row[0];        
                            ?>
                        </li>
                            <li class="lista1">
                              <?php                     
                                 $sql = "SELECT code FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                          echo "<b>Barcode: </b>".$row[0];                                
                             ?>
                        </li>
                        <li class="lista1">
                             <?php                     
                                 $sql = "SELECT manufacturing_places FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Producers address: </b>".$row[0];                                
                             ?>
                        </li>
                        <li class="lista1">
                            <?php                     
                                 $sql = "SELECT categories FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Categories: </b>".$row[0];                                                               
                            ?>
                        </li>
                        <li class="lista1"> 
                            <?php                     
                                 $sql = "SELECT instructions FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Instructions: </b>".$row[0];                                  
                            ?>
                        </li>
                        <li class="lista1"> 
                            <?php                     
                                 $sql = "SELECT risks FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Risks: </b>".$row[0];                                  
                            ?>
                        </li>
                        <li class="lista1"> 
                            <?php                     
                                 $sql = "SELECT valability FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Valability: </b>".$row[0];                                  
                            ?>
                        </li>
                        <li class="lista1"> 
                            <?php                     
                                 $sql = "SELECT transport FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Transport: </b>".$row[0];                                  
                            ?>
                        </li>
                        <li class="lista1"> 
                            <?php                     
                                 $sql = "SELECT packages FROM products where code=".$code.";";
                                 $result = mysqli_query($conn, $sql);
                                     while( $row =  mysqli_fetch_row($result)) 
                                     if($row[0] != "")
                                         echo "<b>Packages: </b>".$row[0];                                  
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="jos" id="comentarii">
                <div class="co">Comments</div>
                <div class="lista1">
                        <ul style="list-style-type:none">
                        <?php
                            $sql = "SELECT com FROM comments where id_produs=".$code.";";
                            $result = mysqli_query($conn, $sql);
                                while( $row =  mysqli_fetch_row($result)) 
                                    echo "<b>Nume persoana  :  </b>". $row[0] . "<br>";
                                            
                        ?>
                        </ul>
                    </div>
            </div>
            <div class="jos1" id="addCom">
                <form action="/comentariu.php" method="post">
                      <input name="name" id="lin" class="inp" placeholder="Add a comment " />
                      <input name="pagina" value="<?php echo $code; ?>" style="display:none" />
                      <input type="submit" id="lin" class="buton" value="SEND" />
                </form>
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
</htmt>