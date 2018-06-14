<?php
session_start();
include "database.php";

$ingrediente = array();

if(isset($_POST["categories1"]))
    $ingrediente[] = "tomatoes";
if(isset($_POST["categories2"]))
    $ingrediente[] = "vegetables";
if(isset($_POST["categories3"]))
    $ingrediente[] = "meat";
if(isset($_POST["categories4"]))
    $ingrediente[] = "fish";
if(isset($_POST["categories5"]))
    $ingrediente[] = "cheese";
if(isset($_POST["categories6"]))
    $ingrediente[] = "fruits";



$sql = 'INSERT INTO products (name_product,code,product_url,ingredients,packages,grams_100,instructions,transport,risks,manufacturing_places,valability,price,image1,image2,image3,country,in_stock,creator)VALUES (\'' .$_POST["name_product"]. '\',' .$_POST["code"]. ',
\'/product.php?code='.$_POST["code"].'\',\'
' .implode(";",$ingrediente).'\',\'
'.$_POST["packages"].'\',\''.$_POST["grams_100"].'\',\''.$_POST["instructions"].'\',\''.$_POST["transport"].'\',\''.$_POST["risks"].'\',\'
'.$_POST["manufacturing_places"].'\',\''.$_POST["valability"].'\','.$_POST["price"].',\''.$_POST["image1"].'\',\''.$_POST["image2"].'\',\''.$_POST["image3"].'\',\''.$_POST["country"].'\',\''.$_POST["in_stock"].'\',\'' .$_COOKIE["loggedUser"]. '\')';

$result = mysqli_query($connection, $sql);
header("Location: /index.php");
?>