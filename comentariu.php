<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "website";
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "INSERT INTO comments(user_p,com,id_produs) VALUES (".$_COOKIE["loggedUser"].", \"".$_POST["name"]."\", ".$_POST["pagina"].")";
$result = mysqli_query($conn, $sql);
header("Location: /product.php?code=".$_POST["pagina"]);
?>