<?php
include "database.php";
libxml_disable_entity_loader(false);
if(!isset($_GET["file"])) {
    header("Location: index.php");
}

$file = $_GET["file"];

$xml = simplexml_load_file("http://localhost".$file);
$fails = 0;

foreach ($xml->product as $product) {
        $product_name = "'".$product->product_name."'";
        $code = $product->code;
        $product_url = "'http://localhost/product.php?code=".$code."'";
        $ingredients = "'".$product->ingredients."'";
        $packages = "'".$product->packages."'";
        $grams = "'".$product->grams_100."'";
        $instructions = "'".$product->instructions."'";
        $transport = "'".$product->transport."'";
        $risks = "'".$product->risks."'";
        $manufacturing = "'".$product->manufacturing_places."'";
        $valability = "'".$product->valability."'";
        $price = "'".$product->price."'";
        $image1 = "'".$product->image1."'";
        $image2 = "'".$product->image2."'";
        $image3 = "'".$product->image3."'";
        $country = "'".$product->country."'";
        $in_stock = $product->in_stock;

        $sql = "INSERT INTO products (name_product,code,product_url,ingredients,packages,grams_100,instructions,transport,risks,manufacturing_places,valability,price,image1,image2,image3,country,in_stock) VALUES ("
        .$product_name.",".$code.",".$product_url.",".$ingredients.",".$packages.",".$grams.",".$instructions.",".$transport.",".$risks.",".$manufacturing.",".$valability.",".$price.",".$image1.",".$image2.",".$image3.",".$country.",".$in_stock.")";
        $result = mysqli_query($connection, $sql);
        if($result == false) {
            $fails++;
            echo mysqli_error($connection)."<br>";
        }
}
if($fails == 0) {
    header("Location: /list.php");
}
?>