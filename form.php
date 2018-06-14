<?php
session_start();
include "database.php";
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/formStyle.css">
        <link href="css/navStyle.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
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
                <div id="menubutton"></div>
                <a href="loggedIndex.php">
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

        <div class="mainInf">
            <div id="font">
                <p>Add a product</p>
            </div>
            <div id="produs">
            <form action="/addForm.php" method="post">
                <div class="categ1">
                    <p>
                        <strong>Mod de preparare</strong>
                    </p>
                    <select class="select" name="moc">
                      <option value="Microunde">Microunde</option>
                      <option value="Aragaz">Aragaz</option>
                      <option value="Blender">Blender</option>
                    </select>                  
                </div>
               
                <div class="categ1">
                     <p>
                         <strong>Number of portions</strong>
                     </p>
                     <select class="select" name="in_stock">
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4 or more">4 or more</option>
                     </select>
                 </div>

                 

                <div class="categ1">
                    <p>
                        <strong>Impachetare</strong>
                    </p>
                    <select class="select" name="packages">
                        <option value="Plastic">Plastic</option>
                        <option value="Carton">Carton</option>
                        <option value="Metal">Metal</option>
                        <option value="Borcan">Borcan</option>
                        <option value="Sticla">Sticla</option>
                        <option value="Caserola">Caserola</option>
                        <option value="Plic">Plic</option>
                        <option value="Other">Other</option>
                    </select>      
                </div>
                
                <div class="imp">
                            <p>Nume produs:</p> <input type="text" class="txt" name="name_product" placeholder="Nume"><br>
                            <p>Cod de bare:</p> <input type="text" class="txt" name="code" placeholder="123456"><br>  
                            <p>Gramaj:</p> <input type="text" class="txt" name="grams_100" placeholder="Valoare cantitatilor din produs"><br> 
                            <p>Instructiuni de preparare:</p><input type="text" class="txt" name="instructions" placeholder="Modul in care se pregateste preparatul"><br> 
                            <p>Transport:</p> <input type="text" class="txt" name="transport" placeholder="Modul in care produsul sa fie transportat"><br> 
                            <p>Alergii,substante daunatoare si riscuri:</p> <input type="text" class="txt" name="risks" ><br> 
                            <p>Adresa producator:</p> <input type="text" class="txt" name="manufacturing_places" placeholder="Locul unde s-a fabricat produsul"><br>
                            <p>Termen de valabilitate:</p> <input type="text" class="txt" name="valability" placeholder="Expira la ..."><br>
                            <p>Tara unde se vinde:</p> <input type="text" class="txt" name="country"><br>
                            <p>Valoare ( Pret ):</p> <input type="text" class="txt" name="price"><br>
                            <p>Imagine produs (TIP URL):</p> <input type="text" class="txt" name="image1"><br>
                            <p>Poza semnificativa 1 (TIP URL - Adresa imaginii):</p> <input type="text" class="txt" name="image2"><br>
                            <p>Poza semnificativa 2 (TIP URL - Adresa imaginii):</p> <input type="text" class="txt" name="image3"><br>
                            
                </div>       
                <div class="categ1">
                    <p>
                        <strong>Ingrediente</strong>
                    </p>
                    
                        <input type="checkbox" name="categories1" value="Tomate">Tomate<br>
                        <input type="checkbox" name="categories2" value="Legume">Legume<br>
                        <input type="checkbox" name="categories3" value="Carne">Carne<br>
                        <input type="checkbox" name="categories4" value="Peste">Peste<br>
                        <input type="checkbox" name="categories5" value="Branza">Branza<br>
                        <input type="checkbox" name="categories6" value="Fructe">Fructe<br>      
                  
                                       
                </div>
                         
                <br><input type="submit" id="lin" class="imp" value="SEND" />  
                </form>
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