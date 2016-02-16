<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//echo '<script type="text/javascript"> alert(\'This email address is already registered\'); </script>';
	ob_start();
	
		include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
						//	die("Connection failed: " . $conn->connect_error);
						}
				
						
						 $spass = md5($_POST["semail"]); 
						//update
                        $sql = "UPDATE signup SET password='".$spass."' WHERE signupid ='".$_POST['uid']."'";
          
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
						//update
                        $sql = "UPDATE fpassword SET fuse=1 WHERE fkey ='".$_POST['ukey']."'";
          
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
mysqli_close($conn); // Closing Connection
echo '<script type="text/javascript"> alert(\'Password updated\'); </script>';

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'login.php';
header("Location: http://$host$uri/$extra");
exit;
ob_end_flush();	

}
?>

<!DOCTYPE html>
<html class="page-login">

    <head>
        <meta charset="UTF-8">
        <title>Update Password | Paperchasers</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/main.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	
		<?php
	$tmpkey = 0;
		$tmpuid = 0;
		 if(isset($_GET["action"]))
		 {
			 
		 }
		 else
		 {
	
		if(isset($_GET["fkey"]))
		{
			$tmpkey = $_GET["fkey"];
		}
	include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						//select
						
						$sql1= "select * from fpassword where fkey='".$tmpkey."' && fuse = 0";
						
						$result = $conn->query($sql1);
					//	$rtmp = $result->fetch_assoc();
												
						//$sql1= "select * from signup where semail='".$_POST["semail"]."',password='".$_POST["password"]."'";
						
						//$result = $conn->query($sql1);
if ($result->num_rows >0) {
 while($row = $result->fetch_assoc()) {
	 $tmpuid = $row["uid"];
 }

} else {
//$error = "Username or Password is invalid";
echo '<script> location.replace("login.php"); </script>';
}
mysqli_close($conn); // 
		 }

?>
    <body class="bg-keyboard">

        <div class="form-box" id="login-box">
            <div class="header"><img src="img/splash/logo1.png" width="50" height="50"></div>
            <form action="updatepassword.php?action=update" method="POST">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="semail" class="form-control" placeholder="Enter your password"/>
						<input type="hidden" name="uid" value = <?php echo $tmpuid; ?> class="form-control"/>
						<input type="hidden" name="ukey" value = <?php echo $tmpkey; ?> class="form-control"/>
                    </div>    
                </div>
                <div class="footer" >                                                               
                    <button type="submit"  class="btn btn-block">Reset Password</button>  

					
                </div>
				</form>
        </div>
	
	

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>


