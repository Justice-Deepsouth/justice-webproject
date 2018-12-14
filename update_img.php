<?php
    session_start();
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'php/dbconnect.php';
    include_once 'php/complaint_photo.php';
    include_once 'php/complaint.php';
    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $complaint_photos = new Complaint_photo($db);
    $complaint = new Complaint($db);

    if (isset($_POST['edit_photo-submit'])) {
        if (isset($_FILES['complaint_photo']['name']) && ($_FILES['complaint_photo']['name'] != "")) {
            $fileName = $_FILES['complaint_photo']['name'];
            $fileTmpName = $_FILES['complaint_photo']['tmp_name'];
            $fileSize = $_FILES['complaint_photo']['size'];
            $fileError = $_FILES['complaint_photo']['error'];
            $fileType = $_FILES['complaint_photo']['type'];

            //1st Delete old files from folder
            if (isset($_POST['complaint-photo-id'])) {
                $complaint_photos->complaint_photo_id = $_POST['complaint-photo-id'];
                $img = $complaint_photos->readone();
                $data = mysqli_fetch_array($img);
                $file_path = 'comp_img/' . $data['complaint_photo_name'];
                $name = $data['complaint_photo_name'];
                unlink($file_path);
    
                //new image upload to folder
                move_uploaded_file($fileTmpName, "comp_img/$name");
            } else {
                $fileName = $old_image;
            }
            $complaint_photos->complaint_photo_id = $_POST['complaint-photo-id'];
            $complaint_photos->complaint_photo_name = $name;
            $complaint_photos->complaint_id = $_POST['complaint-id'];
            if ($complaint_photos->update()) {
                echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
                // header("Location: img_list.php ");
                header("Location: img_list.php?comp_id=".$_POST['complaint-id']);
            } else {
                echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน</div>";
            }
        }
    }
?>