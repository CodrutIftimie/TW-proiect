<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "website";
$conn = mysqli_connect($servername, $username, $password, $database);



$fisier = 'C:\Users\leona\OneDrive\Desktop\test.csv';


if($fp = fopen($fisier, 'r')) {
  while($row = fgetcsv($fp, 1000, ',', '"')) {
    // aici ar trebui sa fie prelucrarile pe date,
    // dar pentru exemplu doar afisez randul
    $sql = 'INSERT INTO products (name_product,code,product_url,ingredients,packages,grams_100,instructions,transport,risks,manufacturing_places,valability,price,image1,image2,image3,country,categories)
    VALUES (\'' .$row[1]. '\',' .$row[0]. ',\'localhost/product.php?code='.$row[2].'\',\'' .$row[3].'\',\'
'.$row[4].'\',\''.$row[5].'\',\''.$row[6].'\',\''.$row[7].'\',\''.$row[8].'\',\'
'.$row[9].'\',\''.$row[10].'\','.$row[11].',\''.$row[12].'\',\''.$row[13].'\'
,\''.$row[14].'\',\''.$row[15].'\',\''.$row[16].'\')';
    echo $sql;
    $result = mysqli_query($conn, $sql);
    echo mysqli_error($conn);

  }  
  fclose($fp);
}





?>