<?php 
//ob_start();

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

        <style>
            .disp-inprocess    {background-color: #fff; }
            .disp-hold         {background-color: #FFFC7F; }
            .disp-106          {background-color: #FF9900; }
            .disp-served       {background-color: #101F78; color: #fff; }
            .disp-outforfiling {background-color: #660066; color: #fff; }
            .table-hover tr:hover {color: #000 !important;}
        </style>

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
					  
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
					
					<?php

 include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$sql ="SELECT * FROM `jobdetail` where jtype = 'Routine'"; 

$result = $conn->query($sql);
$tmproutine = $result->num_rows;

$sql ="SELECT * FROM `jobdetail` where jtype = 'RUSH'"; 

$result = $conn->query($sql);
$tmprush = $result->num_rows;

$sql ="SELECT * FROM `jobdetail` where jtype = 'Expedited'"; 

$result = $conn->query($sql);
$tmpexpe = $result->num_rows;


mysqli_close($conn);
//print_r ($result->fetch_assoc());

?>
                   					
								
								
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php echo$tmproutine; ?>
                                    </h3>
                                    <p>
                                        Active Jobs
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="#" class="small-box-footer job-toggle" data-show-job="active">
                                    Filter All Jobs <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $tmprush; ?>
                                    </h3>
                                    <p>
                                        Active Rush Jobs
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="#" class="small-box-footer job-toggle" data-show-job="rush">
                                    Filter Rush Jobs <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $tmpexpe; ?>
                                    </h3>
                                    <p>
                                        Active Expedited Jobs
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-star"></i>
                                </div>
                                <a href="#" class="small-box-footer job-toggle" data-show-job="expedited">
                                    Filter Expedited Jobs <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        85<sup style="font-size: 20px">%</sup>
                                    </h3>
                                    <p>
                                        Conversion Rate (30 days)
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#modal-conversion" class="small-box-footer" data-toggle="modal">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

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


$sql ="SELECT * FROM `jobdetail` where jtype != 'archive'  "; 


$result = $conn->query($sql);
//print_r ($result->fetch_assoc());
if ($result->num_rows > 0) {
	
	 while($row = $result->fetch_assoc()) {
    ?>
                                
                                            <?php 
                                                $disp = strtolower($row["cdisposition"]);
                                                $disp = str_replace(' ', '', $disp);
                                            ?>
                                            <tr class="row-<?php echo strtolower($row['jtype']);?> disp-<?php echo $disp ;?>">
											<input type="hidden" name="tmp" class="tmp" id="tmp" value= <?php echo $row["jobid"];?> />
                                                <td><?php	echo $row["jobid"] ;?></td>
                                                <td><?php $tmp = strtolower($row['jtype']);
												 if($tmp == "routine")
												 {
													 $tmp = "active";
												 }
												echo "<span class='label job-".$tmp."'>".$row['jtype']."</span>";?></td>
                                                <td><?php
                                                            $rdate = $row["rdate"];
                                                            $rdateNew = date("m-d-Y", strtotime($rdate));
                                                            echo $rdateNew ?></td>
                                                <td><?php	$tmpid11=$row["jcid"] ; include "customerdashboard.php"; echo $tmpcustomer;?></td>
                                                <td><?php	echo $row["wname"] ;?></td>
                                                <td><?php	if (!empty($row["city5"])) { echo $row["city5"]; } 
                                                        elseif (!empty($row["city4"])) { echo $row["city4"]; }
                                                        elseif (!empty($row["city3"])) { echo $row["city3"]; }
                                                        elseif (!empty($row["city2"])) { echo $row["city2"]; }
                                                        else { echo $row["city1"]; } ?>
                                                        
                                                </td>
												<td><?php   $tmpid1=$row["jsid"] ; include "serverdashboard.php"; echo $tmpserver;//echo $row["sname"] ;?></td>
                                                <td><?php	echo $row["cdisposition"] ;?></td>
                                                <td><?php
                                                            $adate = $row["adate"];
                                                            $adateNew = date("m-d-Y", strtotime($adate));
                                                            echo $adateNew ?></td>
                                                <td><?php
                                                            $ddate = $row["ddate"];
                                                            $ddateNew = date("m-d-Y", strtotime($ddate));
                                                            echo $ddateNew ?></td>
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

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 recent-activity">                            
                            <div class="box box-primary ">
                                <div class="box-header">
                                    <h3 class="box-title">Recent Activity</h3>
                                </div>
                                <div class="box-body">
                                    <ul class="list-unstyled">
									<?php include "RecentActivity.php"; ?>
									<?php if ($RecentActivityresult->num_rows > 0) {
	
	 while($Recentrow = $RecentActivityresult->fetch_assoc()) {
	 
	 $tmprec = $Recentrow["lcomment"];
	 $tmpljid = str_replace("Job #".$Recentrow["ljid"],"",$tmprec);
	  $tmprec = $tmpljid;
	 if($Recentrow["chkimg"] ==1)
	 {
	   $tmprec = "Attachments: ".$tmprec;
	 }
	
	 $tmprec = "<a href='jobView.php?id=".$Recentrow["ljid"]."'>Job #".$Recentrow["ljid"]."</a> ".$tmprec;
	 
	 ?>
	 <li><i class="fa fa-file-text-o"></i> <?php echo $tmprec ?></li>
	 <?php
	 
}
}	 ?>
                                        
                                    </ul>
                                    
                                </div><!-- /.box-body -->
                            </div>
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6"> 

                           <!-- Calendar -->
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <h3 class="box-title">Calendar</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>  -->                                       
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar" style="width: 100%"></div>
                                </div><!-- /.box-body -->  
                            </div><!-- /.box --> 
                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- job quick view modals -->
        <!-- Active Jobs Modal -->
        <div class="modal fade" id="modal-active" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Active Jobs</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Rush Jobs Modal -->
        <div class="modal fade" id="modal-rush" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Rush Jobs</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Expedited Jobs Modal -->
        <div class="modal fade" id="modal-expedited" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Expedited Jobs</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Conversion Chart Modal -->
        <div class="modal fade" id="modal-conversion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Conversion Rate (last 30 days)</h4>
              </div>
              <div class="modal-body">
                <div class="chart" id="conversion-chart" style="height: 300px; position: relative;"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


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

        <!-- Dashboard -->
        <script src="js/paperchasers/dashboard.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#dashboard-jobs tbody tr").on('click', function() {
					var tmp = $(this).find('.tmp').val();
                    location.href="jobView.php?id="+tmp+""
                });
				
				});
        </script>

        <!-- live reload (remove after testing) -->
        <!---->

    </body>
</html>