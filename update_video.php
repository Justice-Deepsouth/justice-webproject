<?php
    session_start();
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'php/dbconnect.php';
    include_once 'php/complaint_video.php';
    include_once 'php/complaint.php';
    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $complaint_videos = new Complaint_video($db);
    $complaint = new Complaint($db);

    if (isset($_POST['edit_video-submit'])) {
        if (isset($_FILES['complaint_video']['name']) && ($_FILES['complaint_video']['name'] != "")) {
            $fileName = $_FILES['complaint_video']['name'];
            $fileTmpName = $_FILES['complaint_video']['tmp_name'];
            $fileSize = $_FILES['complaint_video']['size'];
            $fileError = $_FILES['complaint_video']['error'];
            $fileType = $_FILES['complaint_video']['type'];

            //1st Delete old files from folder
            if (isset($_POST['complaint-video-id'])) {
                $complaint_videos->complaint_video_id = $_POST['complaint-video-id'];
                $video = $complaint_videos->readone();
                $data = mysqli_fetch_array($video);
                $file_path = 'comp_video/' . $data['complaint_video_name'];
                $name = $data['complaint_video_name'];
                unlink($file_path);
    
                //new video upload to folder
                move_uploaded_file($fileTmpName, "comp_video/$name");
            } else {
                $fileName = $old_video;
            }
            $complaint_videos->complaint_video_id = $_POST['complaint-video-id'];
            $complaint_videos->complaint_video_name = $name;
            $complaint_videos->complaint_id = $_POST['complaint-id'];
            if ($complaint_videos->update()) {
                echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
                // header("Location: video_list.php ");
                header("Location: video_list.php?comp_id=".$_POST['complaint-id']);
            } else {
                echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน</div>";
            }
        }
    }
?>