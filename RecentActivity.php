	<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$RecentActivitysql ="SELECT * FROM `joblog` ORDER BY `logid` DESC LIMIT 10 "; 

$RecentActivityresult = $conn->query($RecentActivitysql);


?>