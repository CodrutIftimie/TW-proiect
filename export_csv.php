<?php

include "database.php";
$fisier = 'fisier.csv';
$fp = fopen($fisier,'w');
$sql = "SELECT * from products";
$result = mysqli_query($connection, $sql);
while( $row =  mysqli_fetch_row($result)) 
{
    $date = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],
                  $row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17]);
    fputcsv($fp, $date, ',', '"');
}
fclose($fp);
?>