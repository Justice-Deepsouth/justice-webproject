<?php 
    ini_set("include_path", '/home/cp506146/php:' . ini_get("include_path"));
    require_once 'Mail.php'; //this loads up PEAR Mail
    if (!class_exists('Mail')) { die('Error: The PEAR Mail class does not exist.'); }

    $host = 'ssl://justicedeepsouth.in.th';
    $username = 'admin@justicedeepsouth.in.th'; //replace this with your new Gmail address
    $password = '1Uvl7DkqT2Pg'; //replace this with your new Gmail account password
    $port = '465';

    $from_email = $username;
    $from = '"Your Name" <'.$from_email.'>'; //put your name in here, but keep the double quotes
    $to = '"Test Name" <ruchy.tts@gmail.com>'; //put in your name and main email address to send a test to
    $subject = 'Test Message';
    $body = 'If you’re reading this, our test worked.';

    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject,
        'Reply-To' => $from_email,
        'MIME-Version' => 1,
        'Content-type' => 'text/html;UTF-8'
    );

    $params = array(
        'host' => $host,
        'port' => $port,
        'auth' => true,
        'username' => $username,
        'password' => $password
    );

    $smtp = Mail::factory('smtp', $params);
    echo '<p>Preparing to send the test message...</p>';

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo '<p>Error! '.$mail->getMessage().'</p>';
    } else {
        echo '<p>Your test message was sent successfully.</p>';
    }

?>