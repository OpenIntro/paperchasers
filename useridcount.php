	<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$useridcountsql ="SELECT max( signupid ) FROM `signup`"; 

$useridcountresult = $conn->query($useridcountsql);
$rowuseridcountresult = $useridcountresult->fetch_assoc();



?>