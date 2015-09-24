<?php
ob_start();
include "setting.php";
$error=''; // Variable To Store Error Message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//echo '<script type="text/javascript"> alert(\'This email address is already registered\'); </script>';
	
	
		include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
							//die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						//select
						
						$sql1= "select * from signup where semail='".$_POST["semail"]."'AND password='".$_POST["password"]."'";
						
						$result = $conn->query($sql1);
					//	$rtmp = $result->fetch_assoc();
												
						//$sql1= "select * from signup where semail='".$_POST["semail"]."',password='".$_POST["password"]."'";
						
						//$result = $conn->query($sql1);
if ($result->num_rows >0) {
$_SESSION['login_user']="logintrue"; // Initializing Session
 while($row = $result->fetch_assoc()) {
$_SESSION['login_id']= $row["signupid"] ;
 }
header("location: dashboard.php"); // Redirecting To Other Page
//echo '<script type="text/javascript"> alert(\'ok\'); </script>';
} else {
//$error = "Username or Password is invalid";
echo '<script>
      $(function() {
        $("#loginModal").modal();
        $("#loginModal h4").text(\'Your username or password is incorrect. Please try again.\');
      });
    </script>';
}
mysqli_close($conn); // Closing Connection

}
?>

<!DOCTYPE html>
<html class="page-login">
    <head>
        <meta charset="UTF-8">
        <title>Paperchasers | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Theme style -->
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-keyboard">

        <div class="form-box" id="login-box">
            <div class="header"><img src="img/splash/logo1.png" width="50" height="50"></div>
            <form id="form-login" class="form-parsley" action="login.php" method="POST" data-parsley-validate>
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="email" id="semail" name="semail" class="form-control" placeholder="Email Address" data-parsley-trigger="change" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="8" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>          
<!--                     <div class="form-group">
                        <input type="checkbox" name="remember_me"> Remember me
                    </div> -->
                </div>
                <div class="footer" >                                                               
                    <button type="submit"  class="btn btn-block">Login</button>
                    
                    <p ><a href="forget.php">I forgot my password</a></p>
					<p ><a  href="signup.php" >Sign Me Up</a></p>
					
                </div>
			</form>
        </div>

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="arhiveModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Oops!</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <h4></h4>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 5px;">Close</button>                
              </div>
            </div>
          </div>
        </div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.1.2/parsley.min.js" type="text/javascript"></script>

    </body>
</html>


