	<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$serverjobactivesql ="SELECT * FROM `jobdetail` where jtype != 'archive' && jsid = ".$_GET['id'].""; 

$serverjobactiveresult = $conn->query($serverjobactivesql);
$tmpserverjobactive = $serverjobactiveresult->num_rows;

$serverjobcompletedsql ="SELECT * FROM `jobdetail` where jtype = 'archive' && jsid = ".$_GET['id'].""; 

$serverjobcompletedresult = $conn->query($serverjobcompletedsql);
$tmpserverjobcompleted = $serverjobcompletedresult->num_rows;


?>