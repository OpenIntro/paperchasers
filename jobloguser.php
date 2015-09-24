

<?php
include "config.php";
$luconn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($luconn->connect_error) {
    die("Connection failed: " . $luconn->connect_error);
}

//$sql ="SELECT * FROM jobdetail Where jobid ='".$tmpid."' "; 

$lusql ="SELECT * FROM signup where signupid = ".$tmpu." "; 

$luresult = $luconn->query($lusql);
$luroww = $luresult->fetch_assoc();
 

?>
