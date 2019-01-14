<?php
	session_start();
	ob_start();
	
    // set current timezone
	date_default_timezone_set("Asia/Bangkok");

    if (isset($_SESSION['user_session_id']) && isset($_SESSION['user_type'])) {
		// only complainant and justice unit can access
		// user_type = 0 -> admin
		if ($_SESSION['user_type'] == 0) {
			header("Location: admin/admin_main.php");
		}
	} else {
		header("Location: index.php");
	}

	include_once 'php/dbconnect.php';
	include_once 'php/complaint_type.php';
	include_once 'php/complaint.php';
	include_once 'php/complaint_photo.php';
	include_once 'php/complaint_video.php';
	include_once 'php/setting.php';
	
	// get connection
	$database = new Database();
	$db = $database->getConnection();

	$complaint_type = new Complaint_type($db);
	$complaint_photos = new Complaint_photo($db);
	$complaint_videos = new Complaint_video($db);

	// read all records
	$active = true;
	$result = $complaint_type->readall($active);
	$total_rows = $complaint_type->getTotalRows();

	$setting = new Setting($db);
	$mComplaint_ID = $setting->getLast_Complaint_ID();

    // form is submitted
	if (isset($_POST['complaint-status-submit'])) {
		$complaint = new Complaint($db);
		$complaint->complaint_id = $mComplaint_ID;
		$complaint->complaint_title = $_POST['complaint-title'];
		$complaint->complaint_type_id = $_POST['complaint-type-id'];
		$complaint->complaint_desc = $_POST['complaint-desc'];
		$complaint->user_id = $_SESSION['user_id'];
		$complaint->created_date = date("Y/m/d H:i:s");
		if ($complaint->create()) {
			for ($i = 0; $i < count($_FILES['complaint_photo']['name']); $i++) {
				$fileName = $_FILES['complaint_photo']['name'][$i];
				$fileTmpName = $_FILES['complaint_photo']['tmp_name'][$i];
				$fileSize = $_FILES['complaint_photo']['size'][$i];
				$fileError = $_FILES['complaint_photo']['error'][$i];
				$fileType = $_FILES['complaint_photo']['type'][$i];
		
				$fileExt = explode('.', $fileName);
				$fileActualExt = strtolower(end($fileExt));
				$count = $i + 1;
			
				//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
				$type = strrchr($fileName, ".");
				//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
				$newname = $mComplaint_ID . "-img" . $count . $type;
	
				$allowed = array('jpg', 'jpeg', 'png', 'JPG');

				if (in_array($fileActualExt, $allowed)) {
					if ($fileError === 0) {
						if ($fileSize <= 100000000) {
							$fileDestination = 'comp_img/' . $newname;
							if(move_uploaded_file($fileTmpName, $fileDestination)){
								$complaint_photos->complaint_id = $mComplaint_ID;
								$complaint_photos->complaint_photo_name = $mComplaint_ID . "-img" . $count. $type;
								$complaint_photos->complaint_photo_id = $mComplaint_ID . "-img" . $count;
								if ($complaint_photos->create()) {
									$success = true;
								} else {
									$success = false;
								}
							};
							

						} else {
							echo "<div class='alert alert-danger text-center'>" . $fileName . "  ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนด</div>";
						}
					} else {
						echo "<div class='alert alert-danger text-center'>" . $fileName . "  มีปัญหาการอัพโหลดไฟล์</div>";
					}
				} else {
					echo "<div class='alert alert-danger text-center'>" . $fileName . "  คุณไม่สามารถอัพโหลดไฟล์ประเภทนี้ได้</div>";
				}
			}

			// add file video to server and insert to complaint video
			for ($i = 0; $i < count($_FILES['complaint_video']['name']); $i++) {
				$filevName = $_FILES['complaint_video']['name'][$i];
				$filevTmpName = $_FILES['complaint_video']['tmp_name'][$i];
				$filevSize = $_FILES['complaint_video']['size'][$i];
				$filevError = $_FILES['complaint_video']['error'][$i];
				$filevType = $_FILES['complaint_video']['type'][$i];
		
				$filevExt = explode('.', $filevName);
				$filevActualExt = strtolower(end($filevExt));
				$vcount = $i + 1;
			
				//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
				$vtype = strrchr($filevName, ".");
				//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
				$newvname = $mComplaint_ID . "-video" . $vcount . $vtype;
	
				$vallowed = array('mp4', 'mkv', 'flv', '3gp');

				if (in_array($filevActualExt, $vallowed)) {
					if ($filevError === 0) {
						if ($filevSize <= 1000000000) {
							$filevDestination = 'comp_video/' . $newvname;

							if(move_uploaded_file($filevTmpName, $filevDestination)){
								$complaint_videos->complaint_id = $mComplaint_ID;
								$complaint_videos->complaint_video_name = $mComplaint_ID . "-video" . $vcount. $vtype;
								$complaint_videos->complaint_video_id = $mComplaint_ID . "-video" . $vcount;
								if ($complaint_videos->create()) {
									$success = true;
								} else {
									$success = false;
								}
							}
						} else {
							echo "<div class='alert alert-danger text-center'>" . $filevName . "  ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนด</div>";
						}
					} else {
						echo "<div class='alert alert-danger text-center'>" . $filevName . "  มีปัญหาการอัพโหลดไฟล์</div>";
					}
				} else {
					echo "<div class='alert alert-danger text-center'>" . $filevName . "  คุณไม่สามารถอัพโหลดไฟล์ประเภทนี้ได้</div>";
				}
			}
			// add file video to server and insert complaint video //
			$setting->complaint_id_last = $mComplaint_ID;
			$setting->update_complaint_id();
			// header("Location: complaint_status.php");
		}
	}
	ob_end_flush();

?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>หน้าหลักผู้ดูแลระบบ | Justice Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Oxygen:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Chakra+Petch" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		input[type=file] { display: inline; }
		#image_preview {
			/* border: 1px solid black; */
			padding: 10px;
		}
		#image_preview img {
			width: 200px;
			height: 200px;
			padding: 5px;
    	}
  	</style>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php"><img src="images/logo_7.jpg"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">หน้าแรก</a></li>
							<li class="has-dropdown">
								<a href="#">บทความ</a>
								<ul class="dropdown">
									<li><a href="#">ประเภทบทความ 1</a></li>
									<li><a href="#">ประเภทบทความ 2</a></li>
									<li><a href="#">ประเภทบทความ 3</a></li>
									<li><a href="#">ประเภทบทความ 4</a></li>
								</ul>
							</li>
							<li><a href="#">กิจกรรม</a></li>
							<li><a href="complaint_login.php">ร้องเรียน</a></li>
							<li><a href="about.php">เกี่ยวกับโครงการ</a></li>
							<li><a href="contact.php">ติดต่อ</a></li>
							<?php 
								if (!isset($_SESSION['user_session_id'])) {
									echo "<li><a href='complaint_login.php'>เข้าสู่ระบบ</a></li>";
								} else {
									echo "<li class='has-dropdown'>";
									echo "<a href='#'>คุณ " .  $_SESSION['user_id'] . "</a>";
									echo "<ul class='dropdown'>";
									echo "<li><a href='#'>ข้อมูลผู้ใช้งาน</a></li>";
									echo "<li><a href='php/user_logout.php'>ออกจากระบบ</a></li>";
									echo "</ul></li>";
								}
							?>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	<div class="container-wrap">
		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_3.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text slider-text-bg">
				   				<div class="slider-text-inner text-center">
				   					<h1>การจัดการข้อร้องเรียน</h1>
									<h2>Complaint Management</h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>		   	
			  	</ul>
		  	</div>
		</aside>		
		<div id="fh5co-contact">
			<div class="row">
				<!-- sidebar -->
				<div class="col-md-3 col-sm-2">
					<section id="sidebar">
						<header>
							<h3>ประเภทข้อมูล</h3>
						</header>
						<aside>
							<ul class="sidebar-navigation">
								<li class="active"><a href="complaint_status.php"><i class="icon-settings"></i><span> ข้อมูลข้อร้องเรียน</span></a></li>
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
						<div class="col-md-12">
							<h3>เพิ่มข้อร้องเรียน</h3>
						</div>
					</div><!-- /.row -->
					<form role="form" id="complaint" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="หัวข้อร้องเรียน" maxlength="100" name="complaint-title" data-validation="required" data-validation-error-msg="บันทึกหัวข้อร้องเรียน">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control" name="complaint-type-id" data-validation="number" data-validation-allowing="range[1;100]" data-validation-error-msg="บันทึกประเภทข้อร้องเรียน">
									<option value="0">=== เลือกประเภทข้อร้องเรียน ===</option>
									<?php while ($row = mysqli_fetch_array($result)) { ?>
										 <option value="<?php echo $row['complaint_type_id']; ?>" ><?php echo $row['complaint_type_desc']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-offset-7"></div>
                        <div class="col-md-12">
							<div class="form-group">
                            	<textarea name="complaint-desc" class="form-control" cols="30" rows="7" placeholder="รายละเอียดข้อร้องเรียน" data-validation="required" data-validation-error-msg="บันทึกรายละเอียดข้อร้องเรียน"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							ไฟล์คลิป
								<input type="file" id="complaint_video" name="complaint_video[]" multiple >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							ไฟล์ภาพ
								<!-- <input type="file" class="btn btn-primary btn-modify" id= "complaint_photo" name="complaint_photo[]" multiple > -->
								<input type="file" id="complaint_photo" name="complaint_photo[]" multiple >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div id="image_preview"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="บันทึกข้อร้องเรียน" class="btn btn-primary btn-modify" name="complaint-status-submit">
							</div>
						</div>
                        <div class="col-md-12">
							<div class="form-group">
							<div class="progress progress-striped active">
								<div class="progress-bar" style="width:0%"><p id="msg">0%</p></div>
							</div>
							</div>
						</div>
						<div class="col-md-12">
						<?php
							if (isset($success)) {
								if ($success) {
									echo "<div class='alert alert-success text-center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
								} else {
									echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้</div>";
								}
							}
						?>
						</div>
					</div><!-- /.row -->
					</form>
				</div>
			</div>
		</div>
	</div><!-- END container-wrap -->

	<div class="container-wrap">
		<footer id="fh5co-footer" role="contentinfo">
			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2018 (Project Name). All Rights Reserved.</small>
						<!-- <small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Available at <a href="http://themewagon.com/" target="_blank">Themewagon</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small> -->
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>
		</footer>
	</div><!-- END container-wrap -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
    <script type="text/javascript">
  		$("#complaint_photo").change(function(){
     		$('#image_preview').html("");
     		var total_file=document.getElementById("complaint_photo").files.length;
     		for(var i=0;i<total_file;i++) {
      			$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
     		}
  		});
	</script>
	<!-- jQuery Form Validator -->
	<script src="js/form-validator/jquery.form-validator.min.js"></script>
	<script>
		$.validate();
	</script>

	<!-- progress bar -->
	<script src="http://malsup.github.com/jquery.form.js"></script> 
	<script>
	$(function(){
    	$('#complaint').ajaxForm({
        	beforeSend:function(){
            	$('.progress').show();
        	},
        	uploadProgress:function(event,position,total,percentcomplete){
				$('.progress-bar').width(percentcomplete+"%");
				$('#msg').html(percentcomplete+"%")
				if(percentcomplete==100){
					alert("อัพโหลดไฟล์เสร็จสิ้น");
				}
			},
        	success:function(){
				$('.progress').hide();
			},
        	complete:function(){
				window.location.href = "complaint_status.php";
			}
		});
		$('.progress').hide();
	});
	</script>
    <!-- progress bar -->
	</body>
</html>
