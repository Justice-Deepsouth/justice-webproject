<?php
    session_start();
    ob_start();

    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'dbconnect.php';
    include_once 'user.php';
    include_once 'user_log.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to users table
    $user = new User($db);
    // pass connection to user_logs table
    $user_log = new User_log($db);

    if (isset($_POST['txt-user-id']) && isset($_POST['txt-user-passwd'])) {
        $user->user_id = $_POST['txt-user-id'];
        $user->user_passwd = $_POST['txt-user-passwd'];

        $result = $user->readone();

        if ($row = mysqli_fetch_array($result)) {
            session_regenerate_id();                // regenerate session id
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_session_id'] = session_id();
            // insert into user_logs table
            $user_log->session_id = $_SESSION['user_session_id'];
            $user_log->user_id = $row['user_id'];
            $user_log->login_date = date("Y/m/d H:i:s");
            if ($user_log->create()) {
                # code...
            }
            $_SESSION['user_type'] = $row['user_type'];
            if ($row['user_type'] == 1 || $row['user_type'] == 2) {
                // justice unit or complainant
                header("Location: ../complaint_status.php");
            } else {
                // admin
                header("Location: ../admin/admin_main.php");
            }
        } else {
            header("Location: ../complaint_login.php?result=fail");
        }
    }
    ob_end_flush();

?>