<?php 
include "setting.php";
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

$chklogimgupload = 0;

// Check if $uploadOk is set to 0 by an error
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
						
						if (isset($_POST['updatejob'])) {
						
						 $tmp_count = $_POST["actiondate"];
						 
						  if($trimmed == "Routine")
						  {
						    $tmp_count = date('Y-m-d', strtotime($_POST["actiondate"]. ' + 3 days'));
						  }
						   if($trimmed == "Rush")
						  {
						    $tmp_count = date('Y-m-d', strtotime($_POST["actiondate"]. ' + 1 days'));
						  }
						   if($trimmed == "Expedited")
						  {
						    
						    $tmp_count = date('Y-m-d', strtotime($_POST["actiondate"]. ' + 1 days'));
						  }
						
												
						 // $tmp_count_due = date('Y-m-d', strtotime($_POST["actiondate"]. ' + 7 days'));
						 
						      $tmp_count_due = $_POST["duedate"]; 
						      $tmp_count_rec = $_POST["recdate"]; 
						
						}

						// Update Dates button for manual dates
						if (isset($_POST['updatedates'])) {
							$tmp_count = $_POST["actiondate"];
							$tmp_count_due = $_POST["duedate"];
							$tmp_count_rec = $_POST["recdate"];
						}

						if (isset($_POST['SaveInfo'])) {

							$tmp_count = $_POST["actiondate"];
							$tmp_count_due = $_POST["duedate"];
							$tmp_count_rec = $_POST["recdate"];
   
						     $upjob = "Case Info has been updated";
							
						   $sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
								"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
								
								if (mysqli_query($conn, $sql)) {
									//echo "New record created successfully";
								} else {
									//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}
												
						   }
						
						
						
						//update
$sql="UPDATE jobdetail SET jcid = '".$_POST["firm-id"]."',jsid = '".$_POST["server-id"]."',cdisposition =  '".$_POST["optionsRadios"]."' ,
wname = '".$_POST["wname"]."',address1 = '".$_POST["address1"]."',city1 = '".$_POST["city1"]."',state1 = '".$_POST["state1"]."',attempt1 = '".$_POST["attempt1"]."',address2 = '".$_POST["address2"]."',city2 = '".$_POST["city2"]."',state2 = '".$_POST["state2"]."',attempt2 = '".$_POST["attempt2"]."',address3 = '".$_POST["address3"]."',city3 = '".$_POST["city3"]."',state3 = '".$_POST["state3"]."',attempt3 = '".$_POST["attempt3"]."',address4 = '".$_POST["address4"]."',city4 = '".$_POST["city4"]."',state4 = '".$_POST["state4"]."',attempt4 = '".$_POST["attempt4"]."',address5 = '".$_POST["address5"]."',city5 = '".$_POST["city5"]."',state5 = '".$_POST["state5"]."',attempt5 = '".$_POST["attempt5"]."',note = '".$_POST["note"]."' ,udocument = '".$fname."',adocument = '".$trimmed."',plaintiff = '".$_POST["plaintiff"]."',
defendant = '".$_POST["defendant"]."',cnumber = '".$_POST["cnumber"]."',court = '".$_POST["court"]."',jcity = '".$_POST["city"]."',
jstate = '".$_POST["state"]."',jtype = '".$trimmed."',rdate = '".$tmp_count_rec."',adate = '".$tmp_count."',ddate = '".$tmp_count_due."' Where jobid=".$_POST["id"]."";
						
						if (mysqli_query($conn, $sql)) {
							echo "New record created successfully";
							echo $_POST["firm-id"];
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
   
// Job log for manual dates
if (isset($_POST['updatedates'])) {
	if($_POST["actiondate"] != $_POST["tmpactiondate"]) {
	    $upjob = "Action date been updated ".$_POST["actiondate"]; 
	}
	else if($_POST["duedate"] != $_POST["tmpduedate"]) {
	    $upjob = "Due date been updated to ".$_POST["duedate"]; 
	}
	else if($_POST["recdate"] != $_POST["tmprecdate"]) {
	    $upjob = "Received date been updated to ".$_POST["recdate"]; 
	}
	 $sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
	"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$_POST['id'].")"; 
	
	if (mysqli_query($conn, $sql)) {
		//echo "New record created successfully";
	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
test
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

        <link href="css/plugins/datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" />

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

$sql ="SELECT * FROM jobdetail Where jobid ='".$tmpid."' "; 

//$sql ="SELECT * FROM `jobdetail` join addcustomer on jobdetail.jcid = addcustomer.customerid
 //join addserver on jobdetail.jsid = addserver.serverid Where jobdetail.jobid ='".$tmpid."' "; 

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
                <section class="content" id="jobcontent">

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
                                            <a class="btn btn-app <?php echo strtolower($row['jtype']); ?> active">
                                                <i class="<?php 
                                                $jtype = strtolower($row['jtype']);
                                                if ($jtype == "routine")
                                                 {
                                                     echo 'fa fa-check';
                                                 }
                                                 elseif ($jtype == "rush") {
                                                    echo 'ion ion-alert-circled';
                                                }
                                                elseif ($jtype == "expedited") {
                                                    echo 'ion ion-ios7-star';
                                                }
                                                ?>"></i> <?php echo $row["jtype"]; ?>
												
                                            </a>
                                        </div>

										<input type="hidden"  id="jobtype" name = "jobtype" value = <?php echo $row["jtype"]; ?> />
										<input type="hidden"  id="id" name = "id" value = <?php echo $row["jobid"]; ?> />

                                        <div class="col-md-6">
                                            <div class="row">
												<div>
		                                            <span class="date-label">Received Date:</span>
		                                            <span id="rec-date-text" class="date-text"><?php echo $row["rdate"]; ?></span>
		                                            <span id="rec-date-field" class="date-field">
		                                            	<input type="text"  id="recdate" name="recdate" value=<?php echo $row["rdate"]; ?> data-inputmask='"mask": "9999-99-99"' data-mask>
		                                            	<input type="hidden"  id="tmprecdate" name = "tmprecdate" value=<?php echo $row["rdate"]; ?>>
		                                            </span>
		                                            <span class="date-edit"><i class="fa fa-edit"></i></span>
		                                            
	                                            </div>
	                                            <div>
		                                            <span class="date-label">Action Date:</span>
		                                            <span id="action-date-text" class="date-text"><?php echo $row["adate"]; ?></span>
		                                            <span id="action-date-field" class="date-field">
		                                            	<input type="text"  id="actiondate" name = "actiondate" value=<?php echo $row["adate"]; ?> data-inputmask='"mask": "9999-99-99"' data-mask>
	                                            		<input type="hidden"  id="tmpactiondate" name = "tmpactiondate" value=<?php echo $row["adate"]; ?>>
		                                            </span>
		                                            <span class="date-edit"><i class="fa fa-edit"></i></span>
		                                            
	                                            </div>
	                                            <div>
		                                            <span class="date-label">Due Date:</span>
		                                            <span id="due-date-text" class="date-text"><?php echo $row["ddate"]; ?></span>
		                                            <span id="due-date-field" class="date-field">
		                                            	<input type="text"  id="duedate" name="duedate" value=<?php echo $row["ddate"]; ?> data-inputmask='"mask": "9999-99-99"' data-mask />
														<input type="hidden"  id="tmpduedate" name = "tmpduedate" value=<?php echo $row["ddate"]; ?> />
		                                            </span>
		                                            <span class="date-edit"><i class="fa fa-edit"></i></span>
		                                            
	                                            </div>
											</div>

											<button id="updatedates" name="updatedates" class="btn bg-job btn-flat btn-block text-white btn-hover" style="max-width: 200px; margin-top: 10px">Update Dates</button>
                                        </div>
										
											    <!-- <input type="text"  id="actiondate" name = "actiondate" value=<?php echo $row["adate"]; ?> />
												<input type="text"  id="duedate" name = "duedate" value=<?php echo $row["ddate"]; ?> /> -->
												<input type="hidden"  id="tmpuid" name = "tmpuid" value=<?php echo $_SESSION['login_id']; ?> />
												
                                          <div class="col-md-5">
										  <?php $tmparch = "arch.php?id=".$tmpid;  ?>
                                           
											  
											  <div class="btn btn-danger pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#archiveModal"><i class="fa fa-archive"></i> Archive Job</div>
											  
                                            <!-- <a href="forms.html"><button class="btn btn-primary pull-right btn-hover" style="margin-right: 5px;"><i class="fa fa-file-text-o"></i> Generate Affidavit</button></a> -->
                                            <div class="btn btn-primary pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#emailModal"><i class="fa fa-envelope"></i> Email Client</div>
                                       <br/>	<br/><?php $tmparch1 = "delete1.php?id=".$tmpid;  ?>
									     
										 <div class="btn btn-danger pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-archive"></i> Delete Job</div>
										 
																				
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
														
                                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="In Process" <?php if($row["cdisposition"]=="In Process") echo "checked";?>>
                                                                In Process
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bad Address"  <?php if($row["cdisposition"]=="Bad Address") echo "checked";?>>
                                                                Bad Address
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="Hold"  <?php if($row["cdisposition"]=="Hold") echo "checked";?>>
                                                                Hold
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios4" value="106"  <?php if($row["cdisposition"]=="106") echo "checked";?>>
                                                                106
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios5" value="Out for filing"  <?php if($row["cdisposition"]=="Out for filing") echo "checked";?>>
                                                                Out for filing
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios6" value="Served"  <?php if($row["cdisposition"]=="Served") echo "checked";?>>
                                                                Served
                                                            </label>
                                                        </div>
                                                    </div>
													<input type="hidden"  id="tmpcdisposition" name = "tmpcdisposition" value="<?php echo $row["cdisposition"]; ?>"/>
													
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label for="firmName">Witness name</label>
                                                            <input name="wname" type="text" class="form-control" id="witnessName" placeholder="Witness" value="<?php echo $row["wname"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="box attemptbox" id="attempt-box1">
													<div class="box-header">
					                                    <h3 class="box-title" >Attempt 1</h3>

					                                    <div class="box-tools pull-right">
					                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					                                    </div>
					                                </div><!-- /.box-header -->
				                                    <div class="box-body">
		                                                <div class="row">
		                                                    <div class="col-xs-12">
		                                                        <div class="row">
		                                                            <div class="col-sm-6">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Address</label>
		                                                                    <input name="address1" type="text" class="form-control" id="address1" placeholder="Address 1" value="<?php echo $row["address1"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="city">City</label>
		                                                                    <input name="city1" type="text" class="form-control" id="city1" placeholder="City" value="<?php echo $row["city1"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">State/Zip</label>
		                                                                    <input name="state1" type="text" class="form-control" id="state1" placeholder="State/Zip" value="<?php echo $row["state1"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-12">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Attempt Notes</label>
		                                                                    <textarea name="attempt1" id="attempt1" class="form-control"><?php echo $row["attempt1"]; ?></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div> <!-- end box body -->
                                                </div><!-- end attempt box 1 -->
                                                
                                                <div class="box attemptbox" id="attempt-box2" style="display: none">
													<div class="box-header">
					                                    <h3 class="box-title" >Attempt 2</h3>

					                                    <div class="box-tools pull-right">
					                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					                                    </div>
					                                </div><!-- /.box-header -->
				                                    <div class="box-body">
		                                                <div class="row">
		                                                    <div class="col-xs-12">
		                                                        <div class="row">
		                                                            <div class="col-sm-6">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Address</label>
		                                                                    <input name="address2" type="text" class="form-control" id="address2" placeholder="Address 2" value="<?php echo $row["address2"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="city">City</label>
		                                                                    <input name="city2" type="text" class="form-control" id="city2" placeholder="City" value="<?php echo $row["city2"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">State/Zip</label>
		                                                                    <input name="state2" type="text" class="form-control" id="state2" placeholder="State/Zip" value="<?php echo $row["state2"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-12">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Attempt Notes</label>
		                                                                    <textarea name="attempt2" id="attempt2" class="form-control"><?php echo $row["attempt2"]; ?></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div> <!-- end box body -->
                                                </div><!-- end attempt box 2 -->

                                                <div class="box attemptbox" id="attempt-box3" style="display: none">
													<div class="box-header">
					                                    <h3 class="box-title" >Attempt 3</h3>

					                                    <div class="box-tools pull-right">
					                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					                                    </div>
					                                </div><!-- /.box-header -->
				                                    <div class="box-body">
		                                                <div class="row">
		                                                    <div class="col-xs-12">
		                                                        <div class="row">
		                                                            <div class="col-sm-6">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Address</label>
		                                                                    <input name="address3" type="text" class="form-control" id="address3" placeholder="Address 3" value="<?php echo $row["address3"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="city">City</label>
		                                                                    <input name="city3" type="text" class="form-control" id="city3" placeholder="City" value="<?php echo $row["city3"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">State/Zip</label>
		                                                                    <input name="state3" type="text" class="form-control" id="state23" placeholder="State/Zip" value="<?php echo $row["state3"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-12">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Attempt Notes</label>
		                                                                    <textarea name="attempt3" id="attempt3" class="form-control"><?php echo $row["attempt3"]; ?></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div> <!-- end box body -->
                                                </div><!-- end attempt box 3 -->

                                                <div class="box attemptbox" id="attempt-box4" style="display: none">
													<div class="box-header">
					                                    <h3 class="box-title" >Attempt 4</h3>

					                                    <div class="box-tools pull-right">
					                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					                                    </div>
					                                </div><!-- /.box-header -->
				                                    <div class="box-body">
		                                                <div class="row">
		                                                    <div class="col-xs-12">
		                                                        <div class="row">
		                                                            <div class="col-sm-6">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Address</label>
		                                                                    <input name="address4" type="text" class="form-control" id="address4" placeholder="Address 4" value="<?php echo $row["address4"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="city">City</label>
		                                                                    <input name="city4" type="text" class="form-control" id="city4" placeholder="City" value="<?php echo $row["city4"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">State/Zip</label>
		                                                                    <input name="state4" type="text" class="form-control" id="state4" placeholder="State/Zip" value="<?php echo $row["state4"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-12">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Attempt Notes</label>
		                                                                    <textarea name="attempt4" id="attempt4" class="form-control"><?php echo $row["attempt4"]; ?></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div> <!-- end box body -->
                                                </div><!-- end attempt box 2 -->

                                                <div class="box attemptbox" id="attempt-box5" style="display: none">
													<div class="box-header">
					                                    <h3 class="box-title" >Attempt 5</h3>

					                                    <div class="box-tools pull-right">
					                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					                                    </div>
					                                </div><!-- /.box-header -->
				                                    <div class="box-body">
		                                                <div class="row">
		                                                    <div class="col-xs-12">
		                                                        <div class="row">
		                                                            <div class="col-sm-6">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Address</label>
		                                                                    <input name="address5" type="text" class="form-control" id="address5" placeholder="Address 5" value="<?php echo $row["address5"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="city">City</label>
		                                                                    <input name="city5" type="text" class="form-control" id="city5" placeholder="City" value="<?php echo $row["city5"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-3">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">State/Zip</label>
		                                                                    <input name="state5" type="text" class="form-control" id="state5" placeholder="State/Zip" value="<?php echo $row["state5"]; ?>">
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-sm-12">
		                                                                <div class="form-group">
		                                                                    <label for="firmName">Attempt Notes</label>
		                                                                    <textarea name="attempt5" id="attempt5" class="form-control"><?php echo $row["attempt5"]; ?></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div> <!-- end box body -->
                                                </div><!-- end attempt box 2 -->

                                                <div class="btn btn-primary pull-right btn-hover" id="addattempt">Add New Attempt</div>

                                            </div>
                                          
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Upload documents</label>
                                                    <input name="fileToUpload" type="file" id="fileToUpload">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
											
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
	
		//echo htmlentities(stripslashes($Attacheddocumentsroww['uplodname']))."   ";
		$tmpattimgpath = "upload/".htmlentities(stripslashes($Attacheddocumentsroww['uplodname']));
		?>
		 <a class="btn btn-primary btn-sm btn-flat" href='<?php  echo $tmpattimgpath ?>' target="_blank"> <?php  echo htmlentities(stripslashes($Attacheddocumentsroww['uplodname'])) ?>  </a> 
		
		<?php
		}
		}
													 ?>
													
                                                </div>
                                            </div>
											  <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="firmName">Notes (for office use only)</label>
                                                    <textarea name="note" class="form-control"><?php echo htmlspecialchars($row['note']);?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->
                                
                                <div class="box-footer">
								 <button id="updatejob" name="updatejob" class="btn bg-job btn-flat btn-block text-white btn-hover">Update Job</button>
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
        $res = $date->format('m-d-Y');
		$ress = $date->format('h:i:s&\nb\sp;A');
		
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
                                                 <a class="btn btn-primary btn-sm btn-flat" href='<?php  echo $tmpimgpath ?>' target="_blank">Open</a> 
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
                                <div class="box-footer">
                                    <div class="input-group">
                                   <input class="form-control" type="text"  id = "jlname" placeholder="Type message..." autocomplete="off"/> 
									
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"  id="submit-msg"  onclick="return false;" ><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                    </div><!-- /. row job details -->
					
		
	<?php	$tmpid11=$row["jcid"] ; include "archivecustomerdashboard.php"; ?>
                    <!-- Client/Server Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-customer collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title" >  Customer - <em class="text-brand-main"><?php echo $tmpcustomer; ?></em></h3>

                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                                        <a href="customerView.php?id=<?php echo $row["jcid"]; ?>" title="View Customer"><div class="btn btn-default btn-sm"><i class="fa fa-sign-out"></i></div></a>
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="firmName">Firm Name</label>
                                            <input name="fname" type="text" class="form-control" id="firm-name" placeholder="Enter Firm Name" value="<?php echo $tmpcustomer; ?>">
                                        </div>
										
	                                     <input type="hidden" class="form-control" name="firm-id"  id="firm-id" value=<?php echo $row["jcid"]; ?> >
										 <input type="hidden" class="form-control" name="ltmp-firm-id"  id="ltmp-firm-id" value=<?php echo $row["jcid"]; ?> >
										 
                                        <div class="form-group">
                                            <label for="clientName">Client Name</label>
                                            <input name="cname" type="text" class="form-control" id="firm-client-name" placeholder="Enter Client Name" value="<?php echo  $tmpcname; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input name="pnumber" type="tel" class="form-control" id="firm-phone" value="<?php echo $tmppnumber; ?> "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Client Email</label>
                                            <input name="email" type="email" class="form-control" id="firm-email" placeholder="Enter Email" value="<?php echo $tmpemail; ?>">
                                        </div>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!-- end new job - customer section -->

						<?php $tmpid1=$row["jsid"] ; include "archiveserver.php"; //echo $row["sname"] ;?>
                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-server collapsed-box">
                                <div class="box-header">
                                    <h3 class="box-title">Server - <em class="text-brand-main"><?php echo $tmpserversname; ?></em></h3>

                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse" onclick="return false;" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-plus"></i></button>
                                        <a href="serverView.php?id=<?php echo $row["jsid"]; ?>" title="View Server"><div class="btn btn-default btn-sm"><i class="fa fa-sign-out"></i></div></a>
                                    </div>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                               
                                    <div class="box-body">
                                    	<input type="hidden" class="form-control" name = "server-id"  id="server-id" value="<?php echo $row["jsid"]; ?>" >
										
										<input type="hidden" class="form-control" name = "ltmp-server-id"  id="ltmp-server-id" value="<?php echo $row["jsid"]; ?>">
                                        <div class="form-group">
                                            <label for="serverame">Server Name</label>
                                            <input name="sname" type="text" class="form-control" id="serverName" placeholder="Enter Server Name" value="<?php echo $tmpserversname; ?>">
                                        </div>
                                		<div class="form-group">
                                            <label for="firmName">Company Name</label>
                                            <input name="cname" type="text" class="form-control" id="company-name" placeholder="Enter Company Name" value="<?php echo $tmpserver; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input name="pnumber" type="tel"  id="server-phone" class="form-control" value= "<?php echo $tmpserverpnumber; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Email Address</label>
                                            <input name="email" type="email" class="form-control" id="server-email" placeholder="Enter Server Email" value="<?php echo $tmpserveremail; ?>">
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
                                            	<div class="col-xs-12 col-md-4 col-md-offset-4">
                                                    <div class="form-group" style="text-align: center;">
                                                        <label for="causenumber">Cause Number</label>
                                                        <input name="cnumber" type="text" class="form-control" id="causenumber" placeholder="Cause Number" tabindex="1"  style="text-align: center;" value="<?php echo $row["cnumber"]; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="plaintiff">Plaintiff</label>
                                                        <input name="plaintiff" type="text" class="form-control" id="plaintiff" placeholder="Plaintiff" tabindex="2" value="<?php echo $row["plaintiff"]; ?>">
                                                        <span class="between"><strong>vs.</strong></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="courtinfo">Court Info</label>
                                                        <input name="court" type="text" class="form-control" id="courtinfo" placeholder="Court Info" tabindex="4" value="<?php echo $row["court"]; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                            	<div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="defendant">Defendant</label>
                                                        <input name="defendant" type="text" class="form-control" id="defendant" placeholder="Defendant" tabindex="3" value="<?php echo $row["defendant"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="country">County/State</label>
                                                        <input name="city" type="text" class="form-control" id="county" placeholder="County/State" tabindex="5" value="<?php echo $row["jcity"]; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                    <input id="SaveInfo" name="SaveInfo" class="btn bg-job btn-flat btn-block text-white btn-hover" type="submit" value="Save Info"/>
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
                    <input type="text" class="form-control" id="recipient-name" value="<?php echo $tmpemail; ?>">
                  </div>
                  <div class="form-group">
                    <label for="emailMessage" class="control-label">Message:</label>
                    <textarea name="emailMessage" id="emailMessage" class="form-control"></textarea>
                    <br />
                    <p>All attempts, address info and case style will be emailed to the email addresses listed above. Multiple email addresses should be separated with a comma.</p>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-email-client">Send message</button>
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
		
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Delete Job</h4>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="form-group">
                    <h4>Are you sure you want to Delete this job? Please confirm below.</h4>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 5px;">Close</button>
				   <a href=<?php echo $tmparch1 ?> ><div class="btn btn-danger pull-right btn-hover" style="margin-right: 5px;" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-archive"></i> Confirm</div></a>
                
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
        <script src="js/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="js/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {

                $("[data-mask]").inputmask();

                $('#actiondate, #duedate, #recdate').datepicker({
                	format: "yyyy-mm-dd",
				    autoclose: true,
				    todayHighlight: true
				});

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

                $("#jlname").keydown(function(event){
				    if(event.keyCode == 13){
				        $("#submit-msg").click();
				        return false;
				    }
				});

				$("#addattempt").click(function() {
					if (!$("#attempt-box2").is(':visible')) {
						$("#attempt-box2").show();
					} else if (!$("#attempt-box3").is(':visible')) {
						$("#attempt-box3").show();
					} else if (!$("#attempt-box4").is(':visible')) {
						$("#attempt-box4").show();
					} else if (!$("#attempt-box5").is(':visible')) {
						$("#attempt-box5").show();
						$(this).hide();
					}
				});

				if ($("#address5").val() != '' || $("#attempt5").val() != '') {
					$('#attempt-box5,#attempt-box4,#attempt-box3,#attempt-box2').show();
					$('#attempt-box4,#attempt-box3,#attempt-box2,#attempt-box1').addClass('collapsed-box');
					$('#attempt-box4 .box-body,#attempt-box3 .box-body,#attempt-box2 .box-body,#attempt-box1 .box-body').hide();
					$('#attempt-box4 .btn-sm i,#attempt-box3 .btn-sm i,#attempt-box2 .btn-sm i,#attempt-box1 .btn-sm i').addClass('fa-plus').removeClass('fa-minus');
				} else if ($("#address4").val() != '' || $("#attempt4").val() != '') {
					$('#attempt-box4,#attempt-box3,#attempt-box2').show();
					$('#attempt-box3,#attempt-box2,#attempt-box1').addClass('collapsed-box');
					$('#attempt-box3 .box-body,#attempt-box2 .box-body,#attempt-box1 .box-body').hide();
					$('#attempt-box3 .btn-sm i,#attempt-box2 .btn-sm i,#attempt-box1 .btn-sm i').addClass('fa-plus').removeClass('fa-minus');
				} else if ($("#address3").val() != '' || $("#attempt3").val() != '') {
					$('#attempt-box3,#attempt-box2').show();
					$('#attempt-box2,#attempt-box1').addClass('collapsed-box');
					$('#attempt-box2 .box-body,#attempt-box1 .box-body').hide();
					$('#attempt-box2 .btn-sm i,#attempt-box1 .btn-sm i').addClass('fa-plus').removeClass('fa-minus');
				} else if ($("#address2").val() != '' || $("#attempt2").val() != '') {
					$('#attempt-box2').show();
					$('#attempt-box1').addClass('collapsed-box');
					$('#attempt-box1 .box-body').hide();
					$('#attempt-box1 .btn-sm i').addClass('fa-plus').removeClass('fa-minus');
				} 
          
                $("#submit-msg").on( "click", function() {
                	if ($("#jlname").val() != '') {
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
	                            tmphtml += ' <small class="text-muted pull-right">';
	                            tmphtml += item.ltime;
	                            tmphtml += ' <i class="fa fa-clock-o"></i> ';
	                            tmphtml += item.stime;
	                            tmphtml += '</small>';
	                            tmphtml += item.tmpunamee;
	                            tmphtml += '</a>';
	                            tmphtml += item.lcomment;
	                           
	                            
	                             });
	                         tmphtml += '</p></div>';
	                         
	                                            
	                        $( ".chat" ).append( $(tmphtml) );
	                        $('#jlname').val('');
	                        activityBottom();
	                        
	                          // alert(result);
	                          
	                          
	                        }
	                    });
					}
                });

                $('.date-edit').on('click', function() {
                	$(this).prevAll('.date-text').hide();
                	$(this).prevAll('.date-field').show();
                	$(this).hide();
                	$(this).closest('.date-save').show();
                	$('#updatedates').show();
                });

				$('#btn-email-client').on('click', function() {
					var emaildata = {
					    causenumber: $("#causenumber").val(),
					    plaintiff: $("#plaintiff").val(),
					    defendant: $("#defendant").val(),
					    courtinfo: $("#courtinfo").val(),
					    county: $("#county").val(),
					    witness: $("#witnessName").val(),
					    currentDisposition: $("input:radio[name='optionsRadios']:checked").val(),
					    address1: $('#address1').val(),
					    city1: $('#city1').val(),
					    state1: $('#state1').val(),
					    attempt1: $('#attempt1').val(),
					    address2: $('#address2').val(),
					    city2: $('#city2').val(),
					    state2: $('#state2').val(),
					    attempt2: $('#attempt2').val(),
					    address3: $('#address3').val(),
					    city3: $('#city3').val(),
					    state3: $('#state3').val(),
					    attempt3: $('#attempt3').val(),
					    address4: $('#address4').val(),
					    city4: $('#city4').val(),
					    state4: $('#state4').val(),
					    attempt4: $('#attempt4').val(),
					    address5: $('#address5').val(),
					    city5: $('#city5').val(),
					    state5: $('#state5').val(),
					    attempt5: $('#attempt5').val(),
					    recipients: $('#recipient-name').val(),
					    messageTxt: $('#emailMessage').val()
					};

					$.ajax({
					    type: "POST",
					    url: "swift_email.php",
					    data: emaildata,
					    success: function(){
					        $('#emailModal').modal('toggle');
					        $('#emailModal #emailMessage').val('');
					        $('#jobcontent').prepend('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Success!</strong> An email has been sent to the client.</div>');
					        $('#jlname').val('An email has been sent to '+$('#recipient-name').val());
					        $( "#submit-msg" ).trigger( "click" );
					    }
					});
				});

            });
            
            function activityBottom() {
              // scroll activity log to bottom
              var elem = document.getElementById('chat-box');
              elem.scrollTop = elem.scrollHeight;
		    }
            activityBottom();
		</script>

        <!-- live reload (remove after testing) -->
        <!-- -->

    </body>
</html>