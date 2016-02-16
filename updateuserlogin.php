	<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$useridcountsql ="UPDATE signup SET ulastlogin = now() Where signupid = ".$_SESSION['login_id'].""; 
						
						if (mysqli_query($conn,$useridcountsql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}	

?>