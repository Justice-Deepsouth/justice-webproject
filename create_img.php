<?php
session_start();
	
    // set current timezone
date_default_timezone_set("Asia/Bangkok");

    /* if (!isset($_SESSION['user_session_id']) && !isset($_SESSION['user_state'])) {
		if ($_SESSION['user_state'] != 0) {
			header("Location: ../index.php");
		}
	} */
include_once 'php/dbconnect.php';
include_once 'php/complaint_photo.php';
include_once 'php/complaint.php';
// get connection
$database = new Database();
$db = $database->getConnection();



// pass connection to property_types table
$complaint_photos = new Complaint_photo($db);
$complaint = new Complaint($db);




// echo $mComplaint_ID;
// exit(0);

if (isset($_POST['add_photo-submit'])) {
	for ($i = 0; $i < count($_FILES['complaint_photo']['name']); $i++) {

		$fileName = $_FILES['complaint_photo']['name'][$i];
		$fileTmpName = $_FILES['complaint_photo']['tmp_name'][$i];
		$fileSize = $_FILES['complaint_photo']['size'][$i];
		$fileError = $_FILES['complaint_photo']['error'][$i];
		$fileType = $_FILES['complaint_photo']['type'][$i];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		
		
//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
		$type = strrchr($fileName, ".");

//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม

$mComplaint_ID = $complaint_photos->getLast_Complaint_Photo_ID();
if ( $_POST['complaint-photo-id']  !== $mComplaint_ID) {
	$mComplaint_PId  = $_POST['complaint-id']."-img";
	$count = $i+1;
	$running_no = (int)substr($mComplaint_PId, 14, 1) + $count;
	$nComplaint_PId = substr($mComplaint_PId, 0, 14) . $running_no;
			$newname = $nComplaint_PId. $type;
	
}else{


}

	$mComplaint_PId  =  $_POST['complaint-photo-id'];
$count = $i+1;
$running_no = (int)substr($mComplaint_PId, 14, 1) + $count;
$nComplaint_PId = substr($mComplaint_PId, 0, 14) . $running_no;
		$newname = $nComplaint_PId. $type;


		$allowed = array('jpg', 'jpeg', 'png', 'JPG');

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize <= 100000000) {

					$fileDestination = 'comp_img/' . $newname;
					move_uploaded_file($fileTmpName, $fileDestination);
					

				} else {
					echo "<div class='alert alert-danger text-center' $fileName ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนด</div>";
				}
			} else {
				echo "<div class='alert alert-danger text-center' $fileName มีปัญหาการอัพโหลดไฟล์</div>";
			}
		} else {
			echo "<div class='alert alert-danger text-center' $fileName คุณไม่สามารถอัพโหลดไฟล์ประเภทนี้ได้</div>";
		}


        $complaint_photos->complaint_id = $_POST['complaint-id'];
		$count = $i+1;
        $complaint_photos->complaint_photo_name = $newname;
		$complaint_photos->complaint_photo_id =  $nComplaint_PId;
		// echo $_POST['complaint-id'];
		// echo "<br>";
		// echo $mComplaint_PId;
		// echo "<br>";
		// echo $nComplaint_PId;
		// echo "<br>";
		// echo $nComplaint_PId. $type;
		// exit(0);
		if ($complaint_photos->create()) {
			echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
					// header("Location: img_list.php ");
					header("Location: img_list.php?comp_id=".$_POST['complaint-id']);
		} else {
			echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน</div>";
		}
	}
}

?>