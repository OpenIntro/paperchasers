<?php
 include "config.php";
// Create connection
$connserver = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($connserver->connect_error) {
    die("Connection failed: " . $connserver->connect_error);
}
//echo "Connected successfully";
           
	  $tmpserver="";
$connserversql ="SELECT * FROM addserver Where serverid ='".$tmpid1."' "; 

$connserverresult = $connserver->query($connserversql);

if ($connserverresult->num_rows > 0) {
	
	 while($connserverrow = $connserverresult->fetch_assoc()) {
	 
	  $tmpserver=$connserverrow["sname"];
	 
	// <?php	echo $row["fname"] ;
	 
	 
		
} } else {
   // echo "0 results";
}

if (mysqli_query($connserver, $connserversql)) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $connserversql . "<br>" . mysqli_error($connserver);
}

mysqli_close($connserver);


?> 