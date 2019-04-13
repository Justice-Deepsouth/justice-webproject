<?php
    include_once 'php/dbconnect.php';
    include_once 'php/complaint_progress.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $sendemail = new Complaint_progress($db);

    $sendemail->receiver_name = "Ruchdee Binmad";
    $sendemail->receiver_email = "ruchy.tts@gmail.com";
    $sendemail->complaint_title = "ปัญหายาเสพติด";
    
    if ($sendemail->send_email_progress()) {
        echo "<p>Your test message was sent successfully.</p>";
    } else {
        echo "<p>Error! " .$mail->getMessage(). "</p>";
    }

?>


