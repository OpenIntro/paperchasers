<?php
					
				    	$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname="paper";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						//insert
                        $sql="INSERT INTO addserver "."(sname,cname,email,pnumber,saddress,city,state,zcode,country,rating,note)".
						"VALUES "."('".$_POST["sname"]."','".$_POST["cname"]."','".$_POST["email"]."','".$_POST["pnumber"]."','".$_POST["saddress"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["zcode"]."','".$_POST["country"]."','".$_POST["rating"]."','".$_POST["note"]."')"; 

						if (mysqli_query($conn, $sql)) {
							echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}

						mysqli_close($conn);
					?> 