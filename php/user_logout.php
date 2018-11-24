
<?php
session_start();
unset($_SESSION['user_session_id']);
unset( $_SESSION['user_name']);
session_destroy();

header("Location: http://localhost/justice-webproject/");
// echo session_id();
// echo  $_SESSION['user_session_id'];
exit;
?>
