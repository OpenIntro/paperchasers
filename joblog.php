

<?php
//include "config.php";
//$conn=mysqli_connect("localhost","root",'',"jquellco_paper");
// Create connection
$logconn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$logresult = mysqli_query($logconn,"SELECT *  FROM joblog where ljid = ".$tmpid."");
  //echo $result->fetch_assoc();
 // print_r($result->fetch_assoc());
 

?>
