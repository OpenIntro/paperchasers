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
        <title>Forms | Paperchasers</title>
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
                        DEMO - Affidavit of Service
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Affidavit of Service</li>
                    </ol>
                </section>

                <!-- Content Header (Page header) -->
                <div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                </div>

                <!-- Main content -->
                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                Affidavit of Service
                            </h2>
                        </div><!-- /.col -->
                    </div>

                    <!-- info row -->
                    <div class="row">
                        <div class="col-sm-12 text-center cause">
                            <strong>CAUSE NO: 502014CA003089XXXXMBAE</strong>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Court Details-->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <strong>MICHAEL JORDAN<br />
                            VS<br />
                            LEBRON JAMES</strong>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <strong>15<sup>th</sup> CIRCUIT COURT<br /><br />
                            PALM BEACH COUNTY, FLORIDA</strong>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Documents row -->
                    <div class="row aff-row">
                        <div class="col-xs-12">
                        Documents: <strong>SUBPOENA DUCES TECUM</strong>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Received on -->
                    <div class="row aff-row">
                        <div class="col-xs-12">
                        Received on: _________________________ at __________ A.M. / P.M. the above documents to be delivered to:
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="row aff-row">
                        <div class="col-xs-12">
                            <strong>DONNY DONNINGTON <br />
                            1234 MAIN STREET, DALLAS, TX 75231</strong>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Received on -->
                    <div class="row aff-row">
                        <div class="col-xs-12">
                        I, _______________________________, the undersigned, being duly sworn, depose and say, that I am duly authorized under to
                        make delivery of the document(s) listed herein in the above styled case. I am over the age of 18, and am not a party to or
                        otherwise interested in this matter. Delivery of said documents occurred in the following manner:
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                     <div class="row aff-row">
                        <div class="col-xs-12">
                            <strong>By delivering to:</strong>____________________________________________________________________________
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row aff-row">
                        <div class="col-xs-12">
                            <strong>(Title / Relationship):</strong>________________________________________________________________________
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row aff-row">
                        <div class="col-xs-12">
                            <strong>Address of Service:</strong>__________________________________________________________________________
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row aff-row">
                        <div class="col-xs-12">
                            <strong>Date of Service:</strong>_____________________________________ <strong>Time of Service:</strong> _________________________
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row aff-row chk-row">
                        <div class="col-xs-12">
                            <strong>Type of Service:</strong><br />
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    <strong>PERSONAL SERVICE:</strong> Individually and personally to the above named recipient.
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    <strong>CORPORATION / PARTNERSHIP:</strong> By delivering a true copy of said process to an officer, agent or partner of the above
                                    named entity whose name and title is listed above.
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    <strong>POSTING WITH COURT ORDER:</strong> By posting a true copy of said process along with a true copy of the Court Order to the
                                    front entrance of the above listed address.
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">
                                    <strong>NOT FOUND / NOT DELIVERED:</strong> for the following reason: <br/>_______________________________________________________________________________________________________________________________________<br/>
                                    _______________________________________________________________________________________________________________________________________
                                </label>
                            </div>

                            <div class="text-center"><strong>&#8220;I declare under penalties of perjury that the information contained herein is true and correct&#8221;</strong></div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row aff-row">
                        <div class="col-xs-5">
                            ______________________________________________<br />
                            Signature           <span class="pull-right">PS#__________</span><br />
                                               <span class="pull-right">EXP:__________</span>
                        </div><!-- /.col -->

                        <div class="col-xs-5 col-xs-offset-2">
                            Subscribed and sworn to before me, a notary <br />
                            public on _______________________, 20___ <br /><br />

                            _________________________________________<br />
                            Notary Public in and of the State of Texas
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print form-buttons">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            <button class="btn btn-success pull-right" data-toggle="modal" data-target="#email-server"><i class="fa fa-envelope"></i> Email Server</button>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <div class="modal fade" id="email-server">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Confirm Send</h4>
              </div>
              <div class="modal-body">
                <p>You are sending this affadavit (along with the listed attached files) to Jane Janakowski (jane@retrievelegal.com)</p>
                <p><strong>Attached Files:</strong></p>
                <div class="checkbox">
                    <label>
                        <i class="fa fa-check"></i>
                        SUBPOENA DUCES TECUM
                    </label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Send Affidavit</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- Paperchasers App -->
        <script src="js/paperchasers/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                
            });
        </script>

        <!-- live reload (remove after testing) -->
        

    </body>
</html>