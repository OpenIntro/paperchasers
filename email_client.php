<?php

$EmailFrom = "info@etrbe.com";
$EmailTo = "openintro@gmail.com";
$Subject = "Job Update";

$headers = "From: " . $EmailFrom . "\r\n";
$headers .= "Reply-To: ". $EmailFrom . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$causenumber = Trim(stripslashes($_POST['causenumber'])); 
$plaintiff = Trim(stripslashes($_POST['plaintiff'])); 
$defendant = Trim(stripslashes($_POST['defendant'])); 
$courtinfo = Trim(stripslashes($_POST['courtinfo'])); 
$county = Trim(stripslashes($_POST['county'])); 

// validation
$validationOK=true;

// prepare email body text
$message = '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['req-email']) . "</td></tr>";
$message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . strip_tags($_POST['typeOfChange']) . "</td></tr>";
$message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags($_POST['urgency']) . "</td></tr>";
$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
$addURLS = $_POST['addURLS'];
if (($addURLS) != '') {
    $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
}
$curText = htmlentities($_POST['curText']);           
if (($curText) != '') {
    $message .= "<tr><td><strong>CURRENT Content:</strong> </td><td>" . $curText . "</td></tr>";
}
$message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities($_POST['newText']) . "</td></tr>";
$message .= "</table>";

// send email 
$success = mail($EmailTo, $Subject, $message, $headers);

// redirect to success page 
if ($success){
  echo "success";
}
else{
  echo "error";
}
?>