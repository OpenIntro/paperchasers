<?php
ob_start();		
						 include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
						
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						$tmpid  = 0;
						if(isset($_GET['id']))
						{
							$tmpid = $_GET['id'];
						}
									//	echo "hi";
						
							$sql = "DELETE FROM addserver WHERE serverid =".$tmpid .""; 

					
						if (mysqli_query($conn, $sql)) {
							
							echo "New record created successfully";
						} 
						
						else {
							
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
					
						
						mysqli_close($conn);
						
						$host  = $_SERVER['HTTP_HOST'];
						$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						$extra = 'servers.php';
						header("Location: http://$host$uri/$extra");
						exit;
						
							ob_end_flush();	
				?>
