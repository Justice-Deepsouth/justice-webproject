<?php
	session_start();
	ob_start();
	
    // set current timezone
	date_default_timezone_set("Asia/Bangkok");

	include_once 'php/dbconnect.php';
	include_once 'php/complaint_video.php';
	include_once 'php/complaint.php';
	// get connection
	$database = new Database();
	$db = $database->getConnection();

	// pass connection to complaint_videos table
	$complaint_videos = new Complaint_video($db);
	$complaint = new Complaint($db);

	if (isset($_POST['add_video-submit'])) {
		for ($i = 0; $i < count($_FILES['complaint_video']['name']); $i++) {

			$fileName = $_FILES['complaint_video']['name'][$i];
			$fileTmpName = $_FILES['complaint_video']['tmp_name'][$i];
			$fileSize = $_FILES['complaint_video']['size'][$i];
			$fileError = $_FILES['complaint_video']['error'][$i];
			$fileType = $_FILES['complaint_video']['type'][$i];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));
			// echo $fileSize;
			
	//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
			$type = strrchr($fileName, ".");

	//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
			$mComplaint_ID = $complaint_videos->getLast_Complaint_video_ID();
			if ($_POST['complaint-video-id'] !== "") {
				$mComplaint_PId = $_POST['complaint-video-id'];
			} else {
				$mComplaint_PId = $_POST['complaint-id'] . "-video";
			}

			$count = $i + 1;
			$running_no = (int)substr($mComplaint_PId, 16, 1) + $count;
			$nComplaint_PId = substr($mComplaint_PId, 0, 16) . $running_no;
			$newname = $nComplaint_PId . $type;

			$allowed = array('mp4', 'mkv', 'flv', '3gp');

			if (in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if ($fileSize <= 500000000) {
						$fileDestination = 'comp_video/' . $newname;
						move_uploaded_file($fileTmpName, $fileDestination);

						$complaint_videos->complaint_id = $_POST['complaint-id'];
						$count = $i + 1;
						$complaint_videos->complaint_video_name = $newname;
						$complaint_videos->complaint_video_id = $nComplaint_PId;

						if ($complaint_videos->create()) {
							echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
							// header("Location: video_list.php ");		
						} else {
							echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน</div>";
							// header("Location: video_list.php?comp_id=".$_POST['complaint-id']);
						}
					} else {
						echo " $fileName ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนด";
					}
				} else {
					echo "$fileName มีปัญหาการอัพโหลดไฟล์";
				}
			} else {
				echo " $fileName คุณไม่สามารถอัพโหลดไฟล์ประเภทนี้ได้";
			}

		} // end for loop 
		header("Location: video_list.php?comp_id=".$_POST['complaint-id']);
	}
	ob_end_flush();

?>