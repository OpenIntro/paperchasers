<?php 
include "setting.php";
//session_start();
if(isset($_SESSION['login_user'])=="logintrue")
{
	
}
else
{
	
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'login.php';
header("Location: http://$host$uri/$extra");
exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				ob_start();
						// file upload 
						$target_dir = "upload/";
$temp_name = rand(100,1000);

$imageFileType = pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION);
$filename = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_FILENAME);

$fname = $filename."-".$temp_name.".".$imageFileType;
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
   // $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
$chklogimgupload = 0;
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//echo $_FILES["fileToUpload"]["tmp_name"];
		
		include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
		
		$sql="INSERT INTO jobupload "."(uploadjid,uplodname)".
						"VALUES "."(".$_POST['id'].",'".$fname."')"; 
						
						if (mysqli_query($conn, $sql)) {
						//	echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
						$sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid,chkimg)".
						"VALUES "."(".$_POST['tmpuid'].",'".$fname."',now(),".$_POST['id'].",1)"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						$chklogimgupload = 1;
						
		
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
							//die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						
					 //echo "huuuuu";
					 //echo $_POST["jobtype"];
						$trimmed = trim($_POST["jobtype"]);
						//echo $trimmed;
						
						//update
$sql="UPDATE jobdetail SET jcid = '".$_POST["firm-id"]."',jsid = '".$_POST["server-id"]."',cdisposition =  '".$_POST["optionsRadios"]."' ,
wname = '".$_POST["wname"]."',address1 = '".$_POST["address1"]."',attempt1 = '".$_POST["attempt1"]."',address2 = '".$_POST["address2"]."',
attempt2 = '".$_POST["attempt2"]."',note = '".$_POST["note"]."' ,udocument = '".$fname."',adocument = '".$trimmed."',plaintiff = '".$_POST["plaintiff"]."',
defendant = '".$_POST["defendant"]."',cnumber = '".$_POST["cnumber"]."',court = '".$_POST["court"]."',jcity = '".$_POST["city"]."',
jstate = '".$_POST["state"]."',jtype = '".$trimmed."',adate = '".$_POST["actiondate"]."',ddate = '".$_POST["duedate"]."' Where jobid=".$_POST["id"]."";
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}	
						
						if (isset($_POST['updatejob'])) {
        # Publish-button was clicked
		  $upjob = "Job has been updated";
		 
		  if($_POST["optionsRadios"] != $_POST["tmpcdisposition"])
		  {

		  $upjob = $_POST["optionsRadios"];
		  
		  $upjob = "Disposition changed to: " .$upjob;
		  
		  $chklogimgupload = 0;
			 }
 
           if($chklogimgupload == 0)
		   {
			$sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
			}
						
		
   }
   

   
   if($_POST["firm-id"] != $_POST["ltmp-firm-id"])
   {
    $upjob = "Customer has been updated ";
   
   $sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
   
   }
   
   if($_POST["server-id"] != $_POST["ltmp-server-id"])
   {
     //echo '<script type="text/javascript"> alert(\''.$_POST["server-id"].'\'); </script>';
	 // echo '<script type="text/javascript"> alert(\''.$_POST["ltmp-server-id"].'\'); </script>';
    $upjob = "Server has been updated ";
	
   $sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
   }
   
   if (isset($_POST['SaveInfo'])) {
   
     $upjob = "Case Info has been updated";
	
   $sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
   }
	
						mysqli_close($conn);
						
						
						
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'jobView.php?id='.$_POST["id"];
header("Location: http://$host$uri/$extra");
exit;
ob_end_flush();					
							

				}

?>


<!DOCTYPE html>
<html>
<!--
╔═╗┌─┐┌─┐┌─┐┬─┐╔═╗
┬ ┬┌─┐┌─┐┌─┐┬─┐┌─┐
╠═╝├─┤├─┘├┤ ├┬┘║  ├─┤├─┤└─┐├┤ ├┬┘└─┐
╩  ┴ ┴┴  └─┘┴└─╚═╝┴ ┴┴ ┴└─┘└─┘┴└─└─┘
-->
    <head>
        <meta charset="UTF-8">
        <title>Paperchasers | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/main.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
			<script type="text/javascript" src="jss/jquery.min.js"></script>
        <script type="text/javascript" src="jss/script.js"></script>
		
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include "header.php"; ?>
		
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php include "slidbar.php"; ?>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
				<?php
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

//$sql ="SELECT * FROM jobdetail Where jobid ='".$tmpid."' "; 

$sql ="SELECT * FROM `jobdetail` where jobid ='".$tmpid."' "; 

$result = $conn->query($sql);
$row = $result->fetch_assoc();
//print_r ($row); 

    // output data of each row?>
                <section class="content-header">
                    <h1>
                        Job # <?php echo $row["jobid"]; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">View Job</li>
                    </ol>
                </section>

				<form action="jobView.php" method="post" enctype="multipart/form-data" >
                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Case Style-->
                            <div class="box box-primary" id="job-type">
                                <div class="box-header">
                                    <h3 class="box-title">Job Type</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <a class="btn btn-app rush active">
                                                <i class="ion ion-alert-circled"></i> <?php echo $row["jtype"]; ?>
												
                                            </a>
                                        </div>
										<input type="hidden"  id="jobtype" name = "jobtype" value = <?php echo $row["jtype"]; ?> />
												<input type="hidden"  id="id" name = "id" value = <?php echo $row["jobid"]; ?> />
                                        <div class="col-md-6">
                                            Job #: <strong><?php echo $row["jobid"]; ?></strong><br />											 
                                            Next Action Date: <strong><span id="action-date" >
											<?php $originalDate = $row["adate"];
												$newDate = date(" F  d , Y" ,strtotime($originalDate));
												echo $newDate; 
												
												?></span></strong><br />                                            
											due Date: <strong><span id="due-date">
											<?php  $originalDate = $row["ddate"];
												$newDate = date(" F  d , Y" ,strtotime($originalDate));
												echo $newDate;  ?></span></strong>
                                        </div>
										
											<input type="hidden"  id="actiondate" name = "actiondate" value=<?php echo $row["adate"]; ?> />
												<input type="hidden"  id="duedate" name = "duedate" value=<?php echo $row["ddate"]; ?> />
												<input type="hidden"  id="tmpuid" name = "tmpuid" value=<?php echo $_SESSION['login_id']; ?> />
												
                                          <div class="col-md-5">
										  <?php $tmparch = "arch_un.php?id=".$tmpid;  ?>
                                           
											  
											  <div class="btn btn-danger pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#archiveModal"><i class="fa fa-archive"></i>UnArchive Job</div>
											  
                                            <!-- <a href="forms.html"><button class="btn btn-primary pull-right btn-hover" style="margin-right: 5px;"><i class="fa fa-file-text-o"></i> Generate Affidavit</button></a> -->
                                            <div class="btn btn-primary pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#emailModal"><i class="fa fa-envelope"></i> Email Client</div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- end case style section -->
                    </div><!-- /. row (job type) -->

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Case Info-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Job Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group disposition">
                                                    <label for="firmName">Current Disposition</label>

                                                     <div class="form-group">
                                                        <div class="radio">
                                                            <label>
														
														<?php echo $row["cdisposition"] ?>
                                                               
                                                            </label>
                                                        </div>
                                                       
                                                    </div>
													<input type="hidden"  id="tmpcdisposition" name = "tmpcdisposition" value="<?php echo $row["cdisposition"]; ?>" />
													
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label for="firmName">Witness name</label>
															
															:- <?php echo $row["wname"]; ?>
                                                          
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Address 1</label>
																	
																	:- <?php echo $row["address1"]; ?>
                                                                 
																 
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Attempt 1</label>
																	:- <?php echo $row["attempt1"]; ?>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Address 2</label>
																	
																	:- <?php echo $row["address2"]; ?>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Attempt 2</label>
																	:- <?php echo $row["attempt2"]; ?>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>

                                        <div class="row">
                                           
											
	                                       <div class="col-sm-6">
                                                <div class="">
                                                    <label>Attached documents</label>
                                                </div>
                                                <div class="attached-files">
													 <?php 
													 include "Attacheddocuments.php"; 
								
								if($Attacheddocumentsresult)
								{
								while ($Attacheddocumentsroww = $Attacheddocumentsresult->fetch_assoc())
{
	
		echo htmlentities(stripslashes($Attacheddocumentsroww['uplodname']))."   ";
		}
		}
													 ?>
													
                                                </div>
                                            </div>
											  <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="firmName">Notes (for office use only)</label>
													
													:- <?php echo $row["note"]; ?>
													
                                                   
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->
                                
                                <div class="box-footer">
								
								<!-- <input class="btn bg-job btn-flat btn-block text-white btn-hover" type="submit" value="Update Jobb">  -->
<!--<input  type="submit" value="Submit">-->
                                </div>
                            </div><!-- /.box -->
                        </div><!-- end case info section -->
						
						<!-- Activity Log -->
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header" style="cursor: move;">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Job Log</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box" style='padding: 5px 20px 5px 10px; height: 515px; overflow-y: scroll;'>
								
								<?php 
								include "joblog.php"; 
								
								if($logresult)
								{
								while ($roww = $logresult->fetch_assoc())
{
	
		$tmpu=htmlentities(stripslashes($roww['luserid']));
		
			include "jobloguser.php";
			
		$tmpupic = "upload/profile-pic/".$luroww["upic"];
		$date = new DateTime($roww['ltime']);
        $res = $date->format('Y-m-d');
		$ress = $date->format('H:i:s');
		
								?>
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src=<?php echo $tmpupic ?> alt="user image" class="online">
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><?php echo $res; ?> <i class="fa fa-clock-o"></i> <?php echo $ress; ?>
												</small>
                                                <?php //print_r($lurow); 
												echo $luroww["firstname"]?>
                                            </a>
											
											<?php if($roww['chkimg'] == 1) 
                                           {
											?>
											<div class="attachment">
                                            <h4>Attachments:</h4>
                                            <p class="filename">
                                                <?php echo htmlentities(stripslashes($roww['lcomment']));

												 $tmpimgpath = "upload/".htmlentities(stripslashes($roww['lcomment']));
												?>
                                            </p>
                                            <div class="pull-right">
                                                 <a class="btn btn-primary btn-sm btn-flat" href=<?php  echo $tmpimgpath ?> target="_blank">Open</a> 
												<!-- <button class="btn btn-primary btn-sm btn-flat">Open</button> -->
                                            </div>
                                        </div>
										<?php } else { ?>
											 
                                           <?php echo htmlentities(stripslashes($roww['lcomment']));  }?>
                                        </p>
                                    </div>
									<!-- /.item -->
                                    <!-- chat item -->
                                   <?php } } ?>
                                 
                                </div><!-- /.chat -->
                               
                            </div>
                        </div>
						
                    </div><!-- /. row job details -->
					
		

                    <!-- Client/Server Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-customer collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title" >Customer - <em class="text-brand-main"><?php echo $row["fname"]; ?></em></h3>

                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" title="" onclick="return false;" ><i class="fa fa-edit"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
										
										<?php	$tmpid11=$row["jcid"] ; include "archivecustomerdashboard.php"; echo $tmpcustomer;?>
                                            <label for="firmName">Firm Name</label>
											:- <?php echo  $tmpcustomer; ?>
                                        
                                        </div>
									
										 
                                        <div class="form-group">
                                            <label for="clientName">Client Name</label>
											:- <?php echo  $tmpcname;?>
                                          
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
												 <?php echo $tmppnumber;  ?>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Client Email</label>
											<?php echo $tmpemail; ?>
                                           
                                        </div>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!-- end new job - customer section -->

                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-server collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title">Server - <em class="text-brand-main"><?php echo $row["cname"]; ?></em></h3>

                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-default btn-sm" data-toggle="tooltip" onclick="return false;" title=""><i class="fa fa-edit"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                                    <div class="box-body">
                                  <div class="form-group">
								  <?php   $tmpid1=$row["jsid"] ; include "archiveserver.php"; //echo $row["sname"] ;?>
                                            <label for="firmName">Company Name</label>
											:- <?php echo $tmpserver; ?>
                                          
                                        </div>
										
                                        <div class="form-group">
                                            <label for="serverame">Server Name</label>
											:- <?php echo $tmpserversname; ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
											 <?php echo $tmpserverpnumber; ?>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Email Address</label>
											:-  <?php echo $tmpserveremail; ?>
                                            
                                        </div>
                                    </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                        </div><!-- end new job - server section -->
                    </div><!-- /.row (client/server row) -->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Case Info-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Case Info</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="firmName">Plaintiff</label>
														<?php echo $row["plaintiff"]; ?>
                                                        
                                                        <span class="between"><strong>vs.</strong></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="clientName">Defendant</label>
														:- <?php echo $row["defendant"]; ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="firmName">Cause Number</label>
														:- <?php echo $row["cnumber"]; ?>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="clientName">Court</label>
														:- <?php echo $row["court"]; ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="firmName">City</label>
														:- <?php echo $row["jcity"]; ?>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="clientName">State</label>
                                                        
														
														<?php
														     if($row["jstate"]=="AL")  echo " Alabama";
                                                            if($row["jstate"]=="AK")  echo " Alaska";
                                                            if($row["jstate"]=="AZ")  echo " Arizona";
                                                            if($row["jstate"]=="AR")  echo " Arkansas";
                                                             if($row["jstate"]=="CA")  echo " California";
                                                           if($row["jstate"]=="CO")  echo " Colorado";
                                                           if($row["jstate"]=="CT") echo " Connecticut";
                                                             if($row["jstate"]=="DE")  echo " Delaware";
                                                              if($row["jstate"]=="DC")  echo " District Of Columbia";
                                                             if($row["jstate"]=="FL")  echo " Florida";
                                                             if($row["jstate"]=="GA")  echo " Georgia";
                                                             if($row["jstate"]=="HI")  echo " Hawaii";
                                                             if($row["jstate"]=="ID")  echo " Idaho";
                                                            if($row["jstate"]=="IL")  echo " Illinois";
                                                            if($row["jstate"]=="IN")  echo " Indiana";
                                                           if($row["jstate"]=="IA")  echo " Iowa";
                                                              if($row["jstate"]=="KS")  echo " Kansas";
                                                            if($row["jstate"]=="KY")  echo " Kentucky";
                                                            if($row["jstate"]=="LA")  echo " Louisiana";
                                                             if($row["jstate"]=="ME")  echo " Maine";
                                                            if($row["jstate"]=="MD")  echo " Maryland";
                                                           if($row["jstate"]=="MA")  echo " Massachusetts";
                                                              if($row["jstate"]=="MI")  echo " Michigan";
                                                            if($row["jstate"]=="MN")  echo " Minnesota";
                                                           if($row["jstate"]=="MS")  echo " Mississippi";
                                                             if($row["jstate"]=="MO")  echo " Missouri";
                                                             if($row["jstate"]=="MT")  echo " Montana";
                                                            if($row["jstate"]=="NE")  echo " Nebraska";
                                                            if($row["jstate"]=="NV")  echo " Nevada";
                                                          if($row["jstate"]=="NH")  echo " New Hampshire";
                                                            if($row["jstate"]=="NJ")  echo " New Jersey";
                                                             if($row["jstate"]=="NM")  echo " New Mexico";
                                                           if($row["jstate"]=="NY")  echo " New York";
                                                             if($row["jstate"]=="NC")  echo " North Carolina";
                                                           if($row["jstate"]=="ND")  echo " North Dakota";
                                                             if($row["jstate"]=="OH")  echo " Ohio";
                                                            if($row["jstate"]=="OK")  echo " Oklahoma";
                                                              if($row["jstate"]=="OR")  echo " Oregon";
                                                         if($row["jstate"]=="PA")  echo " Pennsylvania";
                                                        if($row["jstate"]=="RI")  echo " Rhode Island";
                                                             if($row["jstate"]=="SC")  echo " South Carolina";
                                                             if($row["jstate"]=="SD")  echo " South Dakota";
                                                        if($row["jstate"]=="TN")  echo " Tennessee";
                                                          if($row["jstate"]=="TX")  echo " Texas";
                                                             if($row["jstate"]=="UT")  echo " Utah";
                                                            if($row["jstate"]=="VT")  echo " Vermont";
                                                          if($row["jstate"]=="VA")  echo " Virginia";
                                                           if($row["jstate"]=="WA")  echo " Washington";
                                                        if($row["jstate"]=="WV")  echo " West Virginia";
                                                          if($row["jstate"]=="WI")  echo " Wisconsin";
                                                        if($row["jstate"]=="WY")  echo " Wyoming";
														   
														?>
                                                         
                                                   
                                                                      
        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                  
								   <!--<input  type="submit" value="Submit">-->
                                </div>
                            </div><!-- /.box -->
                        </div><!-- end case info section -->
                    </div><!-- /. row (case info) -->

                </section><!-- /.content -->
				</form>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="emailModalLabel">Email Client</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name" value="info@florrickagos.com">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">Message:</label>
                    <p style="color:red"><strong>This is not currently working. Updating soon</strong></p>
                    <p>All attempts, address info and case style can be emailed to the client with the click of a button.</p>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
              </div>
            </div>
          </div>
        </div>
							
		<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="arhiveModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Archive Job</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <h4>Are you sure you want to archive this job? Please confirm below.</h4>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 5px;">Close</button>
				   <a href=<?php echo $tmparch ?> ><div class="btn btn-danger pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#archiveModal"><i class="fa fa-archive"></i> Confirm</div></a>
                
              </div>
            </div>
          </div>
        </div>
		

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

        <!-- daterangepicker -->
        <script src="js/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {

                $("[data-mask]").inputmask();

                var substringMatcher = function(strs) {
                  return function findMatches(q, cb) {
                    var matches, substrRegex;
                 
                    // an array that will be populated with substring matches
                    matches = [];
                 
                    // regex used to determine if a string contains the substring `q`
                    substrRegex = new RegExp(q, 'i');
                 
                    // iterate through the pool of strings and for any string that
                    // contains the substring `q`, add it to the `matches` array
                    $.each(strs, function(i, str) {
                      if (substrRegex.test(str)) {
                        // the typeahead jQuery plugin expects suggestions to a
                        // JavaScript object, refer to typeahead docs for more info
                        matches.push({ value: str });
                      }
                    });
                 
                    cb(matches);
                  };
                };

          
                $("#submit-msg").click(function() {
                    var jlname= $("#jlname").val();
                    var jid= $("#id").val();
                    var tmpuid = $("#tmpuid").val();
         
                    $.ajax({
                        type: "POST",
                        url: "2.php",
                        dataType: "json",
                        data:'jlname=' + jlname + '&jid=' + jid + '&tmpuid=' + tmpuid,
                        success: function(data) {
                        
                        var tmphtml  =  '<div class="item">';
                        
                            jQuery.each(data, function(index, item) {
                        
                            tmphtml  +='<img src=';
                            tmphtml += item.tmpupicc;
                            tmphtml += ' alt="user image" class="online">';
                            tmphtml +=  '<p class="message">';
                            tmphtml +=  '<a href="#" class="name">';
                            tmphtml += ' <small class="text-muted pull-right">'
                            tmphtml += item.ltime;
                            tmphtml += ' <i class="fa fa-clock-o"></i>';
                            tmphtml += item.stime;
                            tmphtml += '</small>';
                            tmphtml += item.tmpunamee;
                            tmphtml += '</a>';
                            tmphtml += item.lcomment;
                           
                            
                             });
                         tmphtml += '</p></div>';
                         
                                            
                        $( ".chat" ).append( $(tmphtml) );
                        
                          // alert(result);
                          
                          
                        }
                    });
                });

            });
            
            // scroll activity log to bottom
            window.setInterval(function() {
              var elem = document.getElementById('chat-box');
              elem.scrollTop = elem.scrollHeight;
            }, 5000);
		
		</script>

        <!-- live reload (remove after testing) -->
        <!-- -->

    </body>
</html>