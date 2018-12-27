<?php
    session_start();
    ob_start();
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/activity.php';
    
        // get connection
    $database = new Database();
    $db = $database->getConnection();
    
        // pass connection to property_states table
    $activity = new Activity($db);

    if (isset($_POST['edit_image-submit'])) {
        if (isset($_FILES['activity-image']['name']) && ($_FILES['activity-image']['name'] != "")) {
            $fileName = $_FILES['activity-image']['name'];
            $fileTmpName = $_FILES['activity-image']['tmp_name'];
            $fileSize = $_FILES['activity-image']['size'];
            $fileError = $_FILES['activity-image']['error'];
            $fileType = $_FILES['activity-image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
                    
             //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
            $type = strrchr($fileName, ".");
            //1st Delete old files from folder
            if (isset($_POST['activity-id'])) {
                $activity->activity_id = $_POST['activity-id'];
                $result = $activity->readone();
                $row = mysqli_fetch_array($result);
                $file_path = '../activity_img/' . $row['activity_image'];
                $img = "img-" . $row['activity_name'];
                $newname = $img . $type;
    
                // echo $row['activity_name'];
                // echo $row['activity_image'];
                // exit(0);
              
                unlink($file_path);
    
                //new image upload to folder
                move_uploaded_file($fileTmpName, "../activity_img/$newname");
            } else {
                // $fileName = $old_image;
            }
            $activity->activity_id = $_POST['activity-id'];
            $activity->activity_image = $newname;
            $activity->user_id = $_SESSION['user_id'];
            // $activity->modified_date = date("Y-m-d h:i:sa");
            if ( $activity->update_image()) {
                echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
                header("Location: activities_list.php");
            } else {
                echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน</div>";
                header("Refresh:3; url=activities_list.php");
            }
        }
    }
    ob_end_flush();
?>