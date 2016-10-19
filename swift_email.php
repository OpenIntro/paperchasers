<?php
    require_once 'lib/swift_required.php';

    $messageTxt = Trim(stripslashes($_POST['messageTxt']));
    $recipients = Trim(stripslashes($_POST['recipients'])); 
    $recipientArray = explode(',', $recipients);

    $causenumber = Trim(stripslashes($_POST['causenumber'])); 
    $plaintiff = Trim(stripslashes($_POST['plaintiff'])); 
    $defendant = Trim(stripslashes($_POST['defendant'])); 
    $courtinfo = Trim(stripslashes($_POST['courtinfo'])); 
    $county = Trim(stripslashes($_POST['county']));
    $currentDisposition = Trim(stripslashes($_POST['currentDisposition']));
    $witness = Trim(stripslashes($_POST['witness']));

    $address1= Trim(stripslashes($_POST['address1']));
    $city1= Trim(stripslashes($_POST['city1']));
    $state1= Trim(stripslashes($_POST['state1']));
    $attempt1= Trim(stripslashes($_POST['attempt1']));
    $address2= Trim(stripslashes($_POST['address2']));
    $city2= Trim(stripslashes($_POST['city2']));
    $state2= Trim(stripslashes($_POST['state2']));
    $attempt2= Trim(stripslashes($_POST['attempt2']));
    $address3= Trim(stripslashes($_POST['address3']));
    $city3= Trim(stripslashes($_POST['city3']));
    $state3= Trim(stripslashes($_POST['state3']));
    $attempt3= Trim(stripslashes($_POST['attempt3']));
    $address4= Trim(stripslashes($_POST['address4']));
    $city4= Trim(stripslashes($_POST['city4']));
    $state4= Trim(stripslashes($_POST['state4']));
    $attempt4= Trim(stripslashes($_POST['attempt4']));
    $address5= Trim(stripslashes($_POST['address5']));
    $city5= Trim(stripslashes($_POST['city5']));
    $state5= Trim(stripslashes($_POST['state5']));
    $attempt5= Trim(stripslashes($_POST['attempt5']));

    // Create message body
    $messageBody = '<html>
            <body>'.$messageTxt.'<h2>Case Info</h2>
            <table width="100%" rules="all" style="border-color: #666;" cellpadding="10">
                <tr style="background: #eee;"><td><strong>Cause Number:</strong> </td><td>'.$causenumber.'</td></tr>
                <tr><td width="25%"><strong>Plaintiff:</strong> </td><td>'.$plaintiff.'</td></tr>
                <tr><td width="25%"><strong>Defendant:</strong> </td><td>'.$defendant.'</td></tr>
                <tr><td width="25%"><strong>Court Info:</strong> </td><td>'.$courtinfo.'</td></tr>
                <tr><td width="25%"><strong>County/State:</strong> </td><td>'.$county.'</td></tr>
            </table>
            <h2>Job Details</h2>
            <table width="100%" rules="all" style="border-color: #666;" cellpadding="10">
                <tr style="background: #eee;"><td><strong>Current Disposition:</strong> </td><td>'.$currentDisposition.'</td></tr>
                <tr><td width="25%"><strong>Witness Name:</strong> </td><td>'.$witness.'</td></tr>
            </table>
            <h2>Attempts</h2>
            <table width="100%" rules="all" style="border-color: #666;" cellpadding="10">
                <tr width="100%" style="background: #eee;"><td width="100%" colspan="2"><strong>Attempt 1</strong> </td></tr>
                <tr><td><strong>Address:</strong> </td><td>'.$address1.', '.$city1.', '.$state1.'</td></tr>
                <tr><td width="25%"><strong>Notes:</strong> </td><td>'.$attempt1.'</td></tr>';

    if (!empty($attempt2)) {
        $messageBody .= '<tr width="100%" style="background: #eee;"><td width="100%" colspan="2"><strong>Attempt 2</strong> </td></tr>
                        <tr><td><strong>Address:</strong> </td><td>'.$address2.', '.$city2.', '.$state2.'</td></tr>
                        <tr><td width="25%"><strong>Notes:</strong> </td><td>'.$attempt2.'</td></tr>';
    }

    if (!empty($attempt3)) {
        $messageBody .= '<tr width="100%" style="background: #eee;"><td width="100%" colspan="2"><strong>Attempt 3</strong> </td></tr>
                        <tr><td><strong>Address:</strong> </td><td>'.$address3.', '.$city3.', '.$state3.'</td></tr>
                        <tr><td width="25%"><strong>Notes:</strong> </td><td>'.$attempt3.'</td></tr>';
    }

    if (!empty($attempt4)) {
        $messageBody .= '<tr width="100%" style="background: #eee;"><td width="100%" colspan="2"><strong>Attempt 4</strong> </td></tr>
                        <tr><td><strong>Address:</strong> </td><td>'.$address4.', '.$city4.', '.$state4.'</td></tr>
                        <tr><td width="25%"><strong>Notes:</strong> </td><td>'.$attempt4.'</td></tr>';
    }

    if (!empty($attempt5)) {
        $messageBody .= '<tr width="100%" style="background: #eee;"><td width="100%" colspan="2"><strong>Attempt 5</strong> </td></tr>
                        <tr><td><strong>Address:</strong> </td><td>'.$address5.', '.$city5.', '.$state5.'</td></tr>
                        <tr><td width="25%"><strong>Notes:</strong> </td><td>'.$attempt5.'</td></tr>';
    }
    
    $messageBody .= '</table></body></html>';

    // Create the mail transport configuration
    $transport = Swift_MailTransport::newInstance();
    $mailer = Swift_Mailer::newInstance($transport);
    $message = Swift_Message::newInstance('Service Update')
        ->setFrom(array('info@serversdashboard.com' => 'Paperchasers'))
        ->setTo($recipientArray);
    $message->setBody($messageBody, 'text/html');

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);
?>