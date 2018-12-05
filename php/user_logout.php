<?php
    session_start();

    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'dbconnect.php';
    include_once 'user_log.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to user_logs table
    $user_log = new User_log($db);

    $user_log->session_id = $_SESSION['user_session_id'];
    $user_log->logout_date = date("Y/m/d H:i:s");
    // update user_log
    $user_log->update_logout();

    // delete all sessions
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_session_id']);
    unset($_SESSION['user_type']);
    //unset($_SESSION['user_name']);

    header("Location: ../index.php");
    exit;
?>
