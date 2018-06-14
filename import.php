<?php
@session_start();
$currentDir = getcwd();
$uploadDirectory = "/uploads/";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileName = $_FILES['file']['name'];
    $fileTmpName  = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    if (!$didUpload) die("An error occurred somewhere. Try again or contact the admin");
    else if(strtolower($ext) == "xml") header("Location: /import_xml.php?file=".$uploadDirectory.$fileName);
    else if(strtolower($ext) == "csv") header("Location: /import_csv.php?file=".$uploadDirectory.$fileName);
    else die("Error: Please select a valid file format.");
}
?>