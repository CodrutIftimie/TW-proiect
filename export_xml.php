<?php
session_start();
include "database.php";
$export = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n"; 
$export="<products>";
$sql = "SELECT * from products";
$result = mysqli_query($connection, $sql);
while($row = mysqli_fetch_array($result))
{   
    $export.="<product>";
    $code=$row[0];
    $name_product=$row[1];
    $product_url=$row[2];
    $ingredients=$row[3];
    $packages=$row[4];
    $grams_100=$row[5];
    $instructions=$row[6];
    $transport=$row[7];
    $risks=$row[8];
    $manufacturing_places=$row[9];
    $valability=$row[10];
    $price=$row[11];
    $image1=$row[12];
    $image2=$row[13];
    $image3=$row[14];
    $country=$row[15];
    $created_t=$row[16];
    $in_stock=$row[17];

    $export.='
                <product_name>' .$name_product. '</product_name> 
                            <code>' .$code. '</code> 
                                 <product_url>' .$product_url. '</product_url> 
                                 <ingredients>' .$ingredients. '</ingredients> 
                                 <packages>' .$packages. '</packages> 
                                      <grams_100>' .$grams_100. '</grams_100> 
                                      <instructions>' .$instructions. '</instructions> 
                                      <transport>' .$transport. '</transport> 
                                      <risks>' .$risks. '</risks> 
                                      <manufacturing_places>' .$manufacturing_places. '</manufacturing_places> 
                                  <valability>' .$valability. '</valability> 
                                  <price>' .$price. '</price> 
                                         <image1>' .$image1. '</image1> 
                                         <image2>' .$image2. '</image2> 
                                         <image3>' .$image3. '</image3> 
                                  <country>' .$country. '</country> 
                <in_stock>' .$in_stock. '</in_stock> 
                ';
    $export.="</product>";
}
$export.="</products>";

file_put_contents("products_xml.xml", $export);

?>