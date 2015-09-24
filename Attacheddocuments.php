

<?php
//include "config.php";
//$conn=mysqli_connect("localhost","root",'',"jquellco_paper");
// Create connection
$Attacheddocumentsconn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$Attacheddocumentsresult = mysqli_query($Attacheddocumentsconn,"SELECT *  FROM jobupload where uploadjid = ".$tmpid."");
  //echo $result->fetch_assoc();
 // print_r($result->fetch_assoc());
 

?>
