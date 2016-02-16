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
						include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
//die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						$tmpfirmid = $_POST['firm-id'];
						
						if ($_POST['firm-id']==""){
							
						$sql="INSERT INTO addcustomer "."(fname,cname,email,pnumber)".
						"VALUES "."('".$_POST["firm-name"]."','".$_POST["firm-client-name"]."','".$_POST["firm-email"]."','".$_POST["firm-phone"]."')"; 
						
						
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}						
					$lastid = $conn->insert_id;	
					$tmpfirmid=$lastid;
					
						}
						
						$tmpserverid = $_POST['server-id'];
						
						if ($_POST['server-id']==""){
							
							 $sql1="INSERT INTO addserver "."(sname,cname,email,pnumber)".
						"VALUES "."('".$_POST["serverName"]."','".$_POST["company-name"]."','".$_POST["server-email"]."','".$_POST["server-phone"]."')"; 
						
						
						if (mysqli_query($conn, $sql1)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}						
					$lastid1 = $conn->insert_id;
					$tmpserverid=$lastid1;
					
						}				
					mysqli_close($conn);
					
						
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
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "txt" && $imageFileType != "docx" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//echo $_FILES["fileToUpload"]["tmp_name"];
    } else {
       // echo "Sorry, there was an error uploading your file.";
    }
}


//   inster data start here...........
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
						
						$sql="INSERT INTO jobdetail "."(jcid,jsid,cdisposition,wname,address1,attempt1,address2,attempt2,note,udocument,adocument
						,plaintiff,defendant,cnumber,court,jcity,jstate,jtype,adate,ddate,rdate)".
						"VALUES "."('".$tmpfirmid."','".$tmpserverid."','".$_POST["optionsRadios"]."','".$_POST["wname"]."','".$_POST["address1"]."','".$_POST["attempt1"]."',
						'".$_POST["address2"]."','".$_POST["attempt2"]."','".$_POST["note"]."','".$fname."','".$trimmed."','".$_POST["plaintiff"]."'
						,'".$_POST["defendant"]."','".$_POST["cnumber"]."','".$_POST["court"]."','".$_POST["city"]."','".$_POST["state"]."'
						,'".$trimmed."','".$_POST["actiondate"]."','".$_POST["duedate"]."',now())"; 
					 
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}						
					$lastid = $conn->insert_id;
					
					$upjob = "Job #".$lastid." has been created";
					
					$sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid)".
						"VALUES "."(".$_POST['tmpuid'].",'".$upjob."',now(),".$lastid.")"; 
						
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
						
						mysqli_close($conn);
						
						/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'jobView.php?id='.$lastid;
header("Location: http://$host$uri/$extra");
exit;
ob_end_flush();
						
					}
					?>  

<!DOCTYPE html>
<html>
<!--
╔═╗┌─┐┌─┐┌─┐┬─┐╔═╗┬ ┬┌─┐┌─┐┌─┐┬─┐┌─┐
╠═╝├─┤├─┘├┤ ├┬┘║  ├─┤├─┤└─┐├┤ ├┬┘└─┐
╩  ┴ ┴┴  └─┘┴└─╚═╝┴ ┴┴ ┴└─┘└─┘┴└─└─┘
-->
    <head>
        <meta charset="UTF-8">
        <title>Paperchasers | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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

								<?php
 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$sql ="SELECT MAX(jobid) FROM jobdetail "; 

$result = $conn->query($sql);
$row = $result->fetch_assoc();
//print_r($row);
//echo $row["MAX(customerid)"];
mysqli_close($conn);
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        New Job # <?php $invID = str_pad($row["MAX(jobid)"]+1, 5, '0', STR_PAD_LEFT); echo $invID ;?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">New Job</li>
                    </ol>
                </section>
                  
				 <!-- form start -->
                   <form  action="jobs.php" method="post" enctype="multipart/form-data"  data-parsley-validate>
				   
                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Case Style-->
                            <div class="box box-primary" id="job-type">
                                <div class="box-header">
                                    <input type="text"  id="jobtype" name="jobtype" id="jobtype" class="hide-field" required />
                                    <h3 class="box-title">Job Type</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-app routine">
                                                <i class="fa fa-check"></i> Routine
                                            </a>
                                            <a class="btn btn-app rush">
                                                <i class="ion ion-alert-circled"></i> Rush
                                            </a>
                                            <a class="btn btn-app expedited">
                                                <i class="ion ion-ios7-star"></i> Expedited
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            Job #: <strong><?php $invID = str_pad($row["MAX(jobid)"]+1, 5, '0', STR_PAD_LEFT); echo $invID ;?></strong><br />
                                            Next Action Date: <strong><span id="action-date"></span></strong><br />
                                            Due Date: <strong><span id="due-date"></span></strong>
											
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
								<input type="hidden"  id="actiondate" name = "actiondate" />
								<input type="hidden"  id="duedate" name = "duedate" />
								<input type="hidden"  id="tmpuid" name = "tmpuid" value=<?php echo $_SESSION['login_id']; ?> />
                            </div><!-- /.box -->
                        </div><!-- end case style section -->
                    </div><!-- /. row (job type) -->
					
             
				   
                    <!-- Client/Server Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-customer">
                                <div class="box-header">
                                    <h3 class="box-title">Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                              
                                    <div class="box-body">
									
									
										
                                        <div class="form-group">
                                            <label for="firmName">Firm Name</label>
										
                                            <input name="firm-name" type="text" class="form-control"   id="firm-name" placeholder="Enter Firm Name" required>
							
                                        </div>
										
										
                        
	                                     <input type="hidden" class="form-control" name="firm-id"  id="firm-id" >
                                    
                                        <div class="form-group">
                                            <label for="clientName">Client Name</label>
                                            <input name="firm-client-name" type="text" class="form-control" id="firm-client-name" placeholder="Enter Client Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input name="firm-phone" type="tel" class="form-control" id="firm-phone" data-inputmask='"mask": "(999) 999-9999"' data-mask required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Client Email</label>
                                            <input name="firm-email" type="email" class="form-control" id="firm-email" placeholder="Enter Email" required>
                                        </div>
                                    </div><!-- /.box-body -->
                              
                            </div><!-- /.box -->
                        </div><!-- end new job - customer section -->

                        <div class="col-md-6">
                            <!-- New Job - Customer Section -->
                            <div class="box box-server">
                                <div class="box-header">
                                    <h3 class="box-title">Server</h3>
                                </div><!-- /.box-header -->
                            
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="serverame">Server Name</label>
                                            <input name="serverName" type="text" class="form-control" id="serverName" placeholder="Enter Server Name" required >
                                        </div>
										<input type="hidden" class="form-control" name = "server-id"  id="server-id" >
                                        <div class="form-group">
                                            <label for="firmName">Company Name</label>
                                            <input name="company-name" type="text" class="form-control" id="company-name" placeholder="Enter Company Name" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="serverame">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input name="server-phone" type="tel"  id="server-phone" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask  required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="firmEmail">Email Address</label>
                                            <input name="server-email" type="email" class="form-control" id="server-email" placeholder="Enter Server Email" required >
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
                                
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-4 col-md-offset-4">
                                                    <div class="form-group" style="text-align: center;">
                                                        <label for="firmName">Cause Number</label>
                                                        <input name="cnumber" type="text" class="form-control" id="cnumber" placeholder="Cause Number" tabindex="9" required style="text-align: center;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="firmName">Plaintiff</label>
                                                        <input name="plaintiff" type="text" class="form-control" id="plaintiff" tabindex="10" placeholder="Plaintiff" >
                                                        <span class="between"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="clientName">Court Info</label>
                                                        <input name="court" type="text" class="form-control" id="court" placeholder="Court Info" tabindex="12" required >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="clientName">Defendant</label>
                                                        <input name="defendant" type="text" class="form-control" id="defendant" tabindex="11" placeholder="Defendant" >
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label for="firmName">County/State</label>
                                                        <input name="city" type="text" class="form-control" id="city" tabindex="13" placeholder="County/State" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- end case info section -->
                    </div><!-- /. row (case info) -->

                    <div class="row">
                        <div class="col-md-12">
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
                                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="In Process" checked>
                                                                In Process
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="Bad Address">
                                                                Bad Address
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="Hold">
                                                                Hold
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios4" value="106">
                                                                106
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios5" value="Out for filing">
                                                                Out for filing
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios6" value="Served">
                                                                Served
                                                            </label>
                                                        </div>

														
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label for="firmName">Witness name</label>
                                                            <input name="wname" type="text" class="form-control" id="firmName" placeholder="Witness">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Address 1</label>
                                                                    <input name="address1" type="text" class="form-control" id="firmName" placeholder="Address 1">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Attempt 1</label>
                                                                    <input name="attempt1" type="text" class="form-control" id="firmName" placeholder="Attempt 1">
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
                                                                    <input name="address2" type="text" class="form-control" id="firmName" placeholder="Address 2">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="firmName">Attempt 2</label>
                                                                    <input name="attempt2" type="text" class="form-control" id="firmName" placeholder="Attempt 2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="firmName">Notes (for office use only)</label>
                                                    <textarea name="note" rows="8" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                    <!--<a href="jobs.php"><button class="btn bg-job btn-flat btn-block text-white btn-hover">Save Info</button></a>-->
									<a href="jobView.php"><input class="btn bg-job btn-flat btn-block text-white btn-hover" type="submit" value="Save Info">
                                </div>
								
								
                            </div><!-- /.box -->
                        </div><!-- end case info section -->
                    </div><!-- /. row job details -->

                </section><!-- /.content -->
				</form>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

					
					

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        
        <!-- Validation -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.1.2/parsley.min.js" type="text/javascript"></script>

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

                $('#firm-name').on('input',function(e){
                 
				 $('#firm-id').val("");
    });
	
	$('#company-name').on('input',function(e){
                 
				 $('#server-id').val("");
    });

                // Job Type Button
                $("#job-type .btn").on('click', function() {
                    $("#job-type .btn").removeClass('active');
                    $(this).addClass('active');
                    //alert($( this ).text());
					$('#jobtype').attr('value',$( this ).text());
                    // Action Date
                    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
                    var d = new Date();
                    var curr_date = d.getDate();
                    var curr_month = d.getMonth();
                    curr_month++;
                    curr_month = monthNames[d.getMonth()];
                    var curr_year = d.getFullYear();
                    var fromDate = curr_month +" "+ (curr_date) + ", " + curr_year;
					//var fromDate = m ([ .\t-])* dd [,.stndrh\t ]+ y;

                    if ($(this).hasClass('routine')) {
                        d2 = d.setDate(d.getDate() + 3);
                        var to_date = d.getDate();
                        var to_month = d.getMonth();
                        to_month++;
                        var to_month = monthNames[d.getMonth()];
                        var to_year = d.getFullYear();
                        var toDate = to_month +" "+ (to_date) + ", " + to_year;
						
						 $('#action-date').text(toDate);
						 
						var to_monthh = d.getMonth();
						to_monthh++;
						//var toDatee = to_monthh +"/"+ (to_date) + "/" + to_year;
						var toDatee = to_year +"-"+ to_monthh + "-" + (to_date);
    					$('#actiondate').attr('value',toDatee);

                        // Due Date
                        d = new Date();
                        d3 = d.setDate(d.getDate() + 10);
                        var due_date = d.getDate();
                        var due_month = d.getMonth();
                        due_month++;
                        var due_month = monthNames[d.getMonth()];
                        var due_year = d.getFullYear();
                        var dueDate = due_month +" "+ (due_date) + ", " + due_year;
                        $('#due-date').text(dueDate);
                        
                          var due_monthh = d.getMonth();
                            due_monthh++;
                        //var dueDate = due_monthh +"/"+ (due_date) + "/" + due_year;
                        var dueDatee = due_year +"-"+ due_monthh + "-" + (due_date);
                        $('#duedate').attr('value',dueDatee);
						
                    }
                    else if ($(this).hasClass('rush')) {
                        d2 = d.setDate(d.getDate() + 1);
                        var to_date = d.getDate();
                        var to_month = d.getMonth();
                        to_month++;
                        var to_month = monthNames[d.getMonth()];
                        var to_year = d.getFullYear();
                        var toDate = to_month +" "+ (to_date) + ", " + to_year;
                        $('#action-date').text(toDate);
						
						var to_monthh = d.getMonth();
						to_monthh++;
						//var toDatee = to_monthh +"/"+ (to_date) + "/" + to_year;
						var toDatee = to_year +"-"+ to_monthh + "-" + (to_date);
    					$('#actiondate').attr('value',toDatee);

                        // Due Date
                        d = new Date();
                        d3 = d.setDate(d.getDate() + 7);
                        var due_date = d.getDate();
                        var due_month = d.getMonth();
                        due_month++;
                        var due_month = monthNames[d.getMonth()];
                        var due_year = d.getFullYear();
                        var dueDate = due_month +" "+ (due_date) + ", " + due_year;
                        $('#due-date').text(dueDate);
                        
                          var due_monthh = d.getMonth();
                            due_monthh++;
                        //var dueDate = due_monthh +"/"+ (due_date) + "/" + due_year;
                        var dueDatee = due_year +"-"+ due_monthh + "-" + (due_date);
                        $('#duedate').attr('value',dueDatee);
                    }
                    else if ($(this).hasClass('expedited')) {
                        d2 = d.setDate(d.getDate() + 1);
                        var to_date = d.getDate();
                        var to_month = d.getMonth();
                        to_month++;
                        var to_month = monthNames[d.getMonth()];
                        var to_year = d.getFullYear();
                        var toDate = to_month +" "+ (to_date) + ", " + to_year;
                        $('#action-date').text(toDate);
						
						var to_monthh = d.getMonth();
						to_monthh++;
						//var toDatee = to_monthh +"/"+ (to_date) + "/" + to_year;
						var toDatee = to_year +"-"+ to_monthh + "-" + (to_date);
    					$('#actiondate').attr('value',toDatee);

                        // Due Date
                        d = new Date();
                        d3 = d.setDate(d.getDate() + 4);
                        var due_date = d.getDate();
                        var due_month = d.getMonth();
                        due_month++;
                        var due_month = monthNames[d.getMonth()];
                        var due_year = d.getFullYear();
                        var dueDate = due_month +" "+ (due_date) + ", " + due_year;
                        $('#due-date').text(dueDate);
                        
                          var due_monthh = d.getMonth();
                            due_monthh++;
                        //var dueDate = due_monthh +"/"+ (due_date) + "/" + due_year;
                        var dueDatee = due_year +"-"+ due_monthh + "-" + (due_date);
                        $('#duedate').attr('value',dueDatee);
                    }
                });

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

              
            });
        </script>

        <!-- live reload (remove after testing) -->
        <!-- -->

    </body>
</html>