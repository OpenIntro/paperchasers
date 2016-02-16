<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						ob_start();
						// file upload 
						$target_dir = "upload/profile-pic/";
$temp_name = rand(100,1000);

$imageFileType = pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
//$filename = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_FILENAME);
$fname = "pc_profile_img_".$_POST["maxsignupid"].".".$imageFileType;

//$fname = $filename."-".$temp_name.".".$imageFileType;
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir.$fname;
//echo basename($_FILES["fileToUpload"]["name"]);
//$target_file .="_".$temp_name;
$uploadOk = 1;



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
      $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
   // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//echo $_FILES["fileToUpload"]["tmp_name"];
    } else {
    //    echo "Sorry, there was an error uploading your file.";
    }
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
						
						$sql1= "select * from signup where semail='".$_POST["semail"]."'";
						
						$result = $conn->query($sql1);
						

						
							
							
							if ($result->num_rows >0) {
								
								 echo '<script type="text/javascript"> alert(\'This email address is already registered\'); </script>';
							
							//echo "user email address is already registered";
						}
							
						
						
						else{ 
												
					 	//insert
						 $spass = md5($_POST["password"]); 
						$sql="INSERT INTO signup "."(firstname,lastname,semail,password,upic,sidate,ulastlogin)".
						"VALUES "."('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["semail"]."','".$spass."','".$fname."',now(),now())";
					
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
							$lastid = $conn->insert_id;
						mysqli_close($conn);

include "setting.php";
						
$_SESSION['login_user']="logintrue";
$_SESSION['login_id']= $lastid;						
							/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'dashboard.php';
header("Location: http://$host$uri/$extra");
exit;
	ob_end_flush();		}			
				}


include "useridcount.php";
?>
<!DOCTYPE html>
<html class="page-login">
    <head>
        <meta charset="UTF-8">
        <title>Paperchasers | Sign Up</title>
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
            <form id="form-signup" class="form-parsley" action="signup.php" method="POST" enctype="multipart/form-data" data-parsley-validate>
                <div class="body bg-gray">
                    <h3>Sign up for an account</h3>
					<?php   $maxsignupid = $rowuseridcountresult["max( signupid )"] + 1; ?>
                    <div class="form-group">
					  <input type="hidden" id="maxsignupid" name="maxsignupid" value=<?php echo $maxsignupid ?>> 
                        <input  type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" data-parsley-trigger="change" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <input  type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" data-parsley-trigger="change" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="semail" class="form-control" placeholder="Email Address" data-parsley-trigger="change" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password (min. 8 characters)" minlength="8" data-parsley-trigger="change" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Confirm Password" data-parsley-trigger="change" data-parsley-equalto="#password" required />
                        <i class="fa fa-times"></i>
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="form-group">
                        <label>Upload a profile picture</label>
                        <input name="fileToUpload" type="file" id="fileToUpload">
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" id="btn-signup" class="btn btn-block">Sign me up</button>  
                </div>
				
			
            </form>
		
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.1.2/parsley.min.js" type="text/javascript"></script>

    </body>
</html>