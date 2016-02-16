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
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Star Rating -->
        <link href="css/plugins/star-rating/star-rating.min.css" rel="stylesheet" type="text/css" />
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
                <section class="content-header">
                    <h1>
                        View Customer <button class="btn bg-job btn-flat text-white btn-hover" id="edit-customer">Edit Customer</button>
						<?php $tmparch1 = "deletecustomer.php?id=".$_GET['id'];  ?>
					<a href=<?php echo $tmparch1;?>><button class="btn bg-job btn-flat text-white btn-hover" id="edit-customer">Delete Customer</button>
                    
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.html"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">View Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<form action="customers.php?u=edit" method="post" onsubmit="return(validate());">
				
				<?php
 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$sql ="SELECT * FROM addcustomer Where customerid ='".$_GET['id']."' "; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	 while($row = $result->fetch_assoc()) {
    // output data of each row?>

                    <!-- Main row -->
                    <div class="row">
                        <section class="col-xs-12">
                            <div class="box box-customer">
                                <div class="box-header">
                                    <h3 class="box-title">Customer Information</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body row">
                                    <div class="form-group col-sm-6">
                                        <label for="firm-name">Firm Name</label>
                                       <input type="hidden" name="cid" id="cid" value=<?php echo $row["customerid"] ; ?>>
										<p class="server-data"><?php	echo $row["fname"] ;?></p>     
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Contact Name</label>
                                        <p class="server-data"><?php	echo $row["cname"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Email Address</label>
                                        <p class="server-data"><?php	echo $row["email"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Phone Number</label>
                                        <p class="server-data"><?php	echo $row["pnumber"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Street Address</label>
                                        <p class="server-data"><?php	echo $row["saddress"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">City</label>
                                        <p class="server-data"><?php	echo $row["ccity"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">State</label>
                                        <p class="server-data"><?php	echo $row["state"] ;?></p>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Zip Code</label>
                                        <p class="server-data"><?php	echo $row["zcode"] ;?></p>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="serverName">Notes</label>
                                        <p class="server-data"><?php	echo $row["note"] ;?></p>
                                    </div>
                                </div>
                                <div class="box-footer">
                                <button class="btn bg-job btn-flat btn-block text-white btn-hover">Save Info</button>
                                </div>
                            </div> 
                        </section>
                    </div><!-- /.row (main row) -->
					
					</form>
					
					

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
		<?php									 
} } else {
    echo "0 results";
}

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?> 

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- InputMask -->


        <!-- Star Rating Plugin -->
        <script src="js/plugins/star-rating/star-rating.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            // edit server button
                $('#edit-customer').on('click', function() {
                    $(this).hide();

                    $(".notes .server-data").each(function() {
                      $(this).after('<textarea rows="4" class="form-control server-input">'+$(this).html()+'</textarea>').remove();
                    });
                    
					var i = 1;
                    $(".server-data").each(function() {
                      $(this).after('<input type="text" name = "'+i+'" id = "'+i+'" class="form-control server-input" value="'+$(this).html()+'">').remove();
					  i = i + 1;
                    });
                });
        </script>

        <!-- live reload (remove after testing) -->
        

    </body>
</html>