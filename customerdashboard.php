<?php
 include "config.php";
// Create connection
$conncustomer = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conncustomer->connect_error) {
    die("Connection failed: " . $conncustomer->connect_error);
}
//echo "Connected successfully";
 $tmpcustomer="";          
$tmpid11 = $tmpid11;

$conncustomersql ="SELECT * FROM addcustomer Where customerid ='".$tmpid11."' "; 

$conncustomerresult = $conncustomer->query($conncustomersql);

//print_r($row = $result->fetch_assoc());
if ($conncustomerresult->num_rows > 0) {
	
	 while($conncustomerrow = $conncustomerresult->fetch_assoc()) {
	 
	  $tmpcustomer=$conncustomerrow["fname"];	 
	  //$tmpserver=$row["cname"];
		
} } else {
    //echo "0 results";
}

if (mysqli_query($conncustomer, $conncustomersql)) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $conncustomersql . "<br>" . mysqli_error($conncustomer);
}
//echo $tmpcustomer;
mysqli_close($conncustomer);


?> 