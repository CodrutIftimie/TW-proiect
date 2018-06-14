<?php
include "database.php";
$sql = "INSERT INTO comments(user_p,com,id_produs) VALUES (\"".$_COOKIE["loggedUser"]."\", \"".$_POST["name"]."\", ".$_POST["pagina"].")";
$result = mysqli_query($connection, $sql);
header("Location: /product.php?code=".$_POST["pagina"]);

?>