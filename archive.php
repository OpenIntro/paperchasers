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
        <!-- Morris charts -->
        <link href="css/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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
                        Archive
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Archive</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-xs-12 data-table">                            

                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Active Jobs</h3>
                                </div><!-- /.box-header -->
								<div class="box-body table-responsive">
                                    <table id="dashboard-jobs" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Job #</th>
                                                <th>Type</th>
                                                <th>Received Date</th>
                                                <th>Firm</th>
                                                <th>Witness</th>
                                                <th>City</th>
                                                <th>Server</th>
                                                <th>Current Disposition</th>
                                                <th>Action Date</th>
                                                <th>Due Date</th>
                                            </tr>
                                        </thead>
								
					
					<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$sql ="SELECT * FROM `jobdetail` join addcustomer on jobdetail.jcid = addcustomer.customerid
 join addserver on jobdetail.jsid = addserver.serverid where jobdetail.jtype = 'archive' "; 

$result = $conn->query($sql);
//print_r ($result->fetch_assoc());
if ($result->num_rows > 0) {
	
	 while($row = $result->fetch_assoc()) {
    ?>
                                
                                        <tbody>
                                            <tr class="row-rush">
											<input type="hidden" name="tmp" class="tmp" id="tmp" value= <?php echo $row["jobid"];?> />
                                                <td><?php	echo $row["jobid"] ;?></td>
                                                <td><?php $tmp = strtolower($row['jtype']);
												 if($tmp == "routine")
												 {
													 $tmp = "active";
												 }
												echo "<span class='label job-".$tmp."'>".$row['jtype']."</span>";?></td>
                                               <td><?php	echo $row["rdate"] ;?></td>
                                                <td><?php	echo $row["fname"] ;?></td>
                                                <td><?php	echo $row["wname"] ;?></td>
                                                <td><?php	echo $row["jcity"] ;?></td>
												<td><?php	echo $row["sname"] ;?></td>
                                                <td><?php	echo $row["cdisposition"] ;?></td>
                                                <td><?php	echo $row["adate"] ;?></td>
                                                <td><?php	echo $row["ddate"] ;?></td>
										    </tr>
																
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



                                            
                                        </tbody>
                                        <tfoot>
                                            
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->

                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

        <!-- DATA TABLES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/plug-ins/380cb78f450/api/fnLengthChange.js" type="text/javascript"></script>

        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#archived-jobs tbody tr").on('click', function() {
                    location.href="archiveView.html"
                });

                $("#archived-jobs").dataTable({
                    "order": [ 2, 'des' ],
                    "oLanguage": {
                     "sSearch": "Filter: "
                   }
                });
            });
        </script>

        <!-- live reload (remove after testing) -->
        <!---->

    </body>
</html>