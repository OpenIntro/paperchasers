<?php 
include "setting.php";
ob_start();
include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						
					 //echo "huuuuu";
					 //echo $_POST["jobtype"];
					$tmpid  = 0;
if(isset($_GET['id']))
{
	$tmpid = $_GET['id'];
}
						//echo $trimmed;
						
						//update
$sql="UPDATE jobdetail SET jtype = 'archive' Where jobid=".$tmpid ."";
						
						if (mysqli_query($conn, $sql)) {
						//	echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}	
						
$upjob = "Job #".$tmpid." has been archived";
					
					$sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_SESSION['login_id'].",'".$upjob."',now(),".$tmpid.")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
						
						mysqli_close($conn);
						
						$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'dashboard.php';
header("Location: http://$host$uri/$extra");
exit;
ob_end_flush();
?>