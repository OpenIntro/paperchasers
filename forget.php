<!DOCTYPE html>
<html class="page-login">
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password | Paperchasers</title>
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
    <body class="bg-keyboard">

        <div class="form-box" id="login-box">
            <div class="header"><img src="img/splash/logo1.png" width="50" height="50"></div>
            <form action="forget.php" method="POST">
                <div class="body bg-gray">
                    <div class="form-group">
                    	<label>Please enter your email address</label>
                        <input type="text" name="semail" class="form-control" placeholder="Email Address"/>
                    </div>    
                </div>
                <div class="footer" >                                                               
                    <button type="submit"  class="btn btn-block">Reset Password</button>  

					
                </div>
				</form>
        </div>
		<?php

function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	

	include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						echo "Connected successfully";
						
						//select
						
						$sql1= "select * from signup where semail='".$_POST["semail"]."'";
						
						$result = $conn->query($sql1);
					//	$rtmp = $result->fetch_assoc();
												
						//$sql1= "select * from signup where semail='".$_POST["semail"]."',password='".$_POST["password"]."'";
						
						//$result = $conn->query($sql1);
if ($result->num_rows >0) {

//$row["signupid"] ;
//echo '<script type="text/javascript"> alert(\'ok\'); </script>';
 while($row = $result->fetch_assoc()) {
$tmpkey = generateRandomString();
	$connn = new mysqli($servername, $username, $password,$dbname);
	
	$sqll="INSERT INTO fpassword(uid,fkey,fuse) VALUES(".$row["signupid"].",'".$tmpkey."',0)";
						
						if (mysqli_query($connn, $sqll)) {
						//	echo "New record created successfully";
						//echo "<script type='text/javascript'> alert('$sqll'); </script>";
						} else {
							//echo "Error: " . $sqll . "<br>" . mysqli_error($connn);
						//echo "<script type='text/javascript'> alert('jjjjjj'); </script>";
						}
						
						mysqli_close($connn);
						}
			// the message
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// email envelope
$to  = $_POST["semail"];
$from = 'info@' . $host;
$subject = 'Paperchasers Password Reset';
// email message
$msg = "You have requested a password reset. Please click the link to continue.";
$msg .= "http://" . $host . $uri . "/updatepassword.php?fkey=".$tmpkey;
// email headers
$headers = "From: Paperchasers <" . $from . ">\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);

// send email
mail($to, $subject, $msg, $headers);


} else {
//$error = "Username or Password is invalid";
echo '<script type="text/javascript"> alert(\'email address is not registered\'); </script>';
}
mysqli_close($conn); // 

}
?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>


