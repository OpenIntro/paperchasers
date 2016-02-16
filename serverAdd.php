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

						//Check connection
						if ($conn->connect_error) {
							//die("Connection failed: " . $conn->connect_error);
						}
						//echo "Connected successfully";
						
						//insert
                        $sql="INSERT INTO addserver "."(sname,cname,email,pnumber,saddress,scity,state,zcode,country,rating,note)".
						"VALUES "."('".$_POST["sname"]."','".$_POST["cname"]."','".$_POST["email"]."','".$_POST["pnumber"]."','".$_POST["saddress"]."',
						'".$_POST["scity"]."','".$_POST["state"]."','".$_POST["zcode"]."','".$_POST["country"]."','".$_POST["rating"]."',
						'".$_POST["note"]."')"; 

						if (mysqli_query($conn, $sql)) {
						//	echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}

						$lastid = $conn->insert_id;
						mysqli_close($conn);
						
						/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'serverView.php?id='.$lastid;
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
                        Add Server
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php?"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add Server</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Main row -->
					<form action="serverAdd.php" method="post" data-parsley-validate>
                    <div class="row">
                        <section class="col-xs-12">
                            <div class="box box-server">
                                <div class="box-header">
                                    <h3 class="box-title">Server Information</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body row">
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Server Name</label>
                                        <input name="sname" type="text" class="form-control" id="server-name" placeholder="Enter Server Name" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Company Name</label>
                                        <input name="cname" type="text" class="form-control" id="company-name" placeholder="Enter Company Name" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Email Address</label>
                                        <input name="email" type="email" class="form-control" id="server-email" placeholder="Enter Server's Email Address">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input name="pnumber" type="tel" id="server-phone" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Street Address</label>
                                        <input name="saddress" type="text" class="form-control" id="server-email" placeholder="Enter Street Address">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">City</label>
                                        <input name="scity" type="text" class="form-control" id="server-email" placeholder="Enter City">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">State</label>
                                        <select name="state" class="form-control">
                                            <option value="">- Select -</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="DC">District Of Columbia</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="serverName">Zip Code</label>
                                        <input name="zcode" type="tel" class="form-control" id="server-email" placeholder="Enter Zip Code">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="serverName">County</label>
                                        <input name="country" type="text" class="form-control" id="server-email" placeholder="Enter Server's Main County of Business">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="serverName">Rating</label>
                                        <input name="rating" type="text" id="server-rating" class="rating" data-min="0" data-max="5" data-step="0.5" data-size="xs">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="serverName">Notes</label>
                                        <textarea name="note" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="box-footer">
                                
								<input  href="serverView.php" type = "submit" value = "Save Info" class="btn bg-job btn-flat btn-block text-white btn-hover">
							
                                </div>
                            </div> 
                        </section>
                    </div><!-- /.row (main row) -->
											
   
				
					
					</form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/parsley.js/2.1.2/parsley.min.js" type="text/javascript"></script>

        <!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

        <!-- Star Rating Plugin -->
        <script src="js/plugins/star-rating/star-rating.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $('.rating').rating();
                $("[data-mask]").inputmask();
            });
        </script>

        <!-- live reload (remove after testing) -->
        

    </body>
</html>