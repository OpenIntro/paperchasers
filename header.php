  <header class="header">
            <a href="dashboard.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="img/logo1.png" width="30" height="30"> PaperChasers
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
					<?php 
								include "config.php";
						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
                        
						//print_r($_POST);
						
						//Check connection
						if ($conn->connect_error) {
							//die("Connection failed: " . $conn->connect_error);
						}
					
						
						//select
						
						$sql1= "select * from signup where signupid = ".$_SESSION['login_id']."";
						
						$result = $conn->query($sql1);
					
												
						//$sql1= "select * from signup where semail='".$_POST["semail"]."',password='".$_POST["password"]."'";
						
						//$result = $conn->query($sql1);
if ($result->num_rows >0) {

 while($row = $result->fetch_assoc()) {
  $tmpname = $row["firstname"]." ". $row["lastname"];
    $tmpf = $row["firstname"];
  $tmpimg = $row["upic"];
    $sidate = $row["sidate"];
 }
  $tmpimgg =  "upload/profile-pic/".$tmpimg;
} 

							?>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $tmpname; ?> <i class="caret"></i></span>
                            </a>
						
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src=<?php echo $tmpimgg; ?> class="img-circle" alt="User Image" />
                                    <p>
                                      <?php echo $tmpname; ?>
                                        <small>Member since <?php  $newDate = date(" F  Y" ,strtotime($sidate)); echo $newDate; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                    <!-- Info or links could go here -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="signout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>