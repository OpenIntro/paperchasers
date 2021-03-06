<?php 

session_start();
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



<!doctype html>
<html lang="en">
<!--
╔═╗┌─┐┌─┐┌─┐┬─┐╔═╗┬ ┬┌─┐┌─┐┌─┐┬─┐┌─┐
╠═╝├─┤├─┘├┤ ├┬┘║  ├─┤├─┤└─┐├┤ ├┬┘└─┐
╩  ┴ ┴┴  └─┘┴└─╚═╝┴ ┴┴ ┴└─┘└─┘┴└─└─┘
-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Paperchasers</title>
    <meta name="description" content="Managing your services made simple">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600">
            <link rel="stylesheet" href="css/splash.css">
        </head>
<body>
    <header class="frontpage">
        <div class="frame">
            <a href="" class="logo"><img src="img/splash/logo1.png" width="65" height="65">Paperchasers</a>
                
                <h1 class="skewa">Managing your services, made simple</h1>
                <h2 class="skewaa">Less busy work. <span>More real work.</span></h2>
                <form>
                    <a href="login.php"><button class="btn-login"  type="button">Get started</button></a>
                </form>
            </div>
    </header>
    <div id="container">
        <div class="content">
    <div class="frame">    
        <div class="style">
            <ul class="two">
                <li>
                    <div class="image">
                        <img src="img/splash/dashboard.png">
                    </div>
                    <div class="head">
                        <h3>Quick Dashboard Access</h3>
                        <p>Quickly see the status of active jobs. Make modifications. Add attempts.</p>
                    </div>
                </li>
                <li>
                    <div class="image">
                        <img src="img/splash/screens.png">
                    </div>
                    <div class="head">
                        <h3>Device optimized</h3>
                        <p>Whether you are at your desk or on the go with your phone or tablet, the application is optimized for every device!</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
    </div>
    <footer>
        <div class="social">
            <a href="#" target="_blank" rel="nofollow"><img src="img/splash/twitter.png" width="22" height="18"></a>
            <a href="#" target="_blank" rel="nofollow"><img src="img/splash/facebook.png" width="10" height="22"></a>
            <p>support@paperchasers.com</p>
        </div>
        
        v.<span class="version">0.1</span>
    </footer>

            </body>
</html>
