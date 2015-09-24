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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
	
	
	<?php

  //ho $_POST["1"];
  //print_r($_POST);
					if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_GET['u'])=='edit'){
				    	 include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						//update
                        $sql = "UPDATE addserver SET sname='".$_POST["1"]."', cname='".$_POST["2"]."',email='".$_POST["3"]."', pnumber='".$_POST["4"]."', 
						saddress= '".$_POST["5"]."',scity='".$_POST["6"]."', state='".$_POST["7"]."',zcode='".$_POST["8"]."',country='".$_POST["9"]."',rating='".$_POST["rating"]."',note='".$_POST["tmptax"]."'
						WHERE serverid ='".$_POST['sid']."'";
          
						if (mysqli_query($conn, $sql)) {
							//echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}

						mysqli_close($conn);
					}
					?>
	
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
                        Servers <a href="serverAdd.php"><button class="btn bg-job btn-flat text-white btn-hover">Add New Server</button></a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Servers</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-xs-12 data-table">                            

                            <div class="box box-server">
                                <div class="box-body table-responsive">
                                    <table id="servers-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Name</th>
                                                <th>Active Jobs</th>
                                                <th>Total Jobs</th>
                                                <th>County</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										 include "config.php";
											// Create connection
											$conn = new mysqli($servername, $username, $password,$dbname);

											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}
											//echo "Connected successfully";
											$sql = "SELECT * FROM addserver";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													
														
$sql ="SELECT * FROM `jobdetail` where jsid = ".$row["serverid"].""; 

$resultt = $conn->query($sql);
$tmptotoalj = $resultt->num_rows;

$sql ="SELECT * FROM `jobdetail` where jsid = ".$row["serverid"]." && jtype != 'archive'"; 
$resultt = $conn->query($sql);
$tmpactivej = $resultt->num_rows;
												
													?>
													<tr>
													<input type="hidden" name="tmp" class="tmp" id="tmp" value= <?php echo $row["serverid"];?> />
																							<td><?php echo $row["sname"];?></td>
																							<td><?php echo $row["cname"];?></td>
																							<td><?php  echo $tmpactivej;?></td>
																							<td> <?php echo $tmptotoalj; ?></td>
																							<td><?php echo $row["country"];?></td>
																							<td><?php echo $row["scity"];?></td>
																							<td><?php echo $row["state"]?></td>
																							<td><?php echo $row["rating"];?></td>
																						</tr>
													<?php 
																						

													}
											} else {
												echo "0 results";
											}

											if (mysqli_query($conn, $sql)) {
											   // echo "New record created successfully";
											} else {
												//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}

											mysqli_close($conn);


											?>

 											
									    </tbody>    
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- /.Left col -->

                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- DATA TABLES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- Star Rating Plugin -->
        <script src="js/plugins/star-rating/star-rating.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#servers-table").dataTable({
                    "columnDefs": [
                        { "width": "125px", "targets": 7 }
                    ],
                    "order": [ 7, 'asc' ],
                    "oLanguage": {
                     "sSearch": "Filter: "
                   }
                });

                $("#servers-table tbody tr").on('click', function() {
					var tmp = $(this).find('.tmp').val();
				
					location.href="serverView.php?id="+tmp+""
                 
                });

                $('.rating').rating("refresh", {disabled:true, showClear:false, showCaption: false, size: 'xs'});
            });
        </script>

        <!-- live reload (remove after testing) -->
        

    </body>
</html>