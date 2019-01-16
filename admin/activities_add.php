<?php
session_start();
ob_start();

    // set current timezone
date_default_timezone_set("Asia/Bangkok");

if (isset($_SESSION['user_session_id']) && isset($_SESSION['user_type'])) {
		// only admin type can access
	if ($_SESSION['user_type'] != 0) {
		header("Location: ../index.php");
	}
} else {
	header("Location: ../index.php");
}

 // form is submitted
if (isset($_POST['activity-submit'])) {

	include_once '../php/dbconnect.php';
	include_once '../php/activity.php';

    // get connection
	$database = new Database();
	$db = $database->getConnection();

    // pass connection to property_states table
	$activity = new Activity($db);
	if (isset($_POST['activity-submit'])) {
		if (isset($_POST['activity-image'] )) {
		$fileName = $_FILES['activity-image']['name'];
		$fileTmpName = $_FILES['activity-image']['tmp_name'];
		$fileSize = $_FILES['activity-image']['size'];
		$fileError = $_FILES['activity-image']['error'];
		$fileType = $_FILES['activity-image']['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
                
         //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
		$type = strrchr($fileName, ".");
        
        //ตั้งชื่อไฟล์ใหม่โดยชื่อกิจกรรมไว้หน้าชื่อไฟล์เดิม
		$img = "img-" . $_POST['activity-name'];
		$newname = $img . $type;
    
        //อนุญาตให้นามสกุลนี้บันทึกได้
		$allowed = array('jpg', 'jpeg', 'png', 'JPG');

		if ($_POST['activity-edate'] > $_POST['activity-sdate']) {
			if (in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if ($fileSize <= 100000000) {
						$fileDestination = '../activity_img/' . $newname;
						move_uploaded_file($fileTmpName, $fileDestination);

                   
                         //ข้อมูลที่จะบันทึก
						$activity->activity_name = $_POST['activity-name'];
						$activity->activity_desc = $_POST['activity-desc'];
						$activity->activity_place = $_POST['activity-place'];
						$activity->activity_sdate = $_POST['activity-sdate'];
						$activity->activity_edate = $_POST['activity-edate'];
						$activity->activity_image = $newname;
						$activity->user_id = $_SESSION['user_id'];
							// $activity->created_date = date("Y/m/d h:i:sa");
					
						if ($activity->create()) {
							echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
							header("Location: activities_list.php");
						} else {
							echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน มีภาพ</div>";
							header("Refresh:3; url=activities_add.php");
						}

					} else {
						echo "<div class='alert alert-danger text-center' $fileName ไฟล์มีขนาดใหญ่เกินกว่าที่กำหนด</div>";
						header("Refresh:3; url=activities_add.php");
					}
				} else {
					echo "<div class='alert alert-danger text-center' $fileName มีปัญหาการอัพโหลดไฟล์</div>";
					header("Refresh:3; url=activities_add.php");
				}
			} else {
				echo "<div class='alert alert-danger text-center' $fileName คุณไม่สามารถอัพโหลดไฟล์ประเภทนี้ได้</div>";
				header("Refresh:3; url=activities_add.php");
			}
		} else {
			echo "<div class='alert alert-danger text-center'>วันเริ่มงานไม่สามารถมากกว่าวันสิ้นสุดงาน</div>";
			header("Refresh:3; url=activities_add.php");
		}
	}else{
		//ข้อมูลที่จะบันทึก
	   $activity->activity_name = $_POST['activity-name'];
	   $activity->activity_desc = $_POST['activity-desc'];
	   $activity->activity_place = $_POST['activity-place'];
	   $activity->activity_sdate = $_POST['activity-sdate'];
	   $activity->activity_edate = $_POST['activity-edate'];
	   $activity->activity_image = null;
	   $activity->user_id = $_SESSION['user_id'];
		   // $activity->created_date = date("Y/m/d h:i:sa");
   
	   if ($activity->create()) {
		   echo "<div class='alert alert-success text-center'>อัพโหลดไฟล์สำเร็จ</div>";
		   header("Location: activities_list.php");
	   } else {
		   echo "<div class='alert alert-danger text-center'>Create ไม่ผ่าน ไม่มีภาพ</div>";
		   header("Refresh:3; url=activities_add.php");
	   }


	}
	}

}
ob_end_flush();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>หน้าเพิ่มกิจกรรม | Justice Project</title>
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
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="../css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/style.css">

	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="../index.php"><img src="../images/logo2.png"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="../index.php">หน้าแรก</a></li>
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
							<li><a href="../complaint_login.php">ร้องเรียน</a></li>
							<li><a href="../about.html">เกี่ยวกับโครงการ</a></li>
							<li><a href="../contact.php">ติดต่อ</a></li>
							<?php 
						if (!isset($_SESSION['user_session_id'])) {
							echo "<li><a href='../complaint_login.php'>เข้าสู่ระบบ</a></li>";
						} else {
							echo "<li class='has-dropdown'>";
							echo "<a href='#'>คุณ " . $_SESSION['user_id'] . "</a>";
							echo "<ul class='dropdown'>";
							echo "<li><a href='#'>ข้อมูลผู้ใช้งาน</a></li>";
							echo "<li><a href='../php/user_logout.php'>ออกจากระบบ</a></li>";
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
			   	<li style="background-image: url(../images/img_bg_3.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text slider-text-bg">
				   				<div class="slider-text-inner text-center">
				   					<h1>การจัดการข้อมูล</h1>
										<h2>Data Management</h2>
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
								<li><a href="admin_main.php"><i class="icon-settings"></i><span> ข้อมูลการติดต่อ</span></a></li>
								<li><a href="complaint_types_list.php"><i class="icon-settings"></i><span> ประเภทข้อร้องเรียน</span></a></li>
								<li><a href="complaint_states_list.php"><i class="icon-settings"></i><span> สถานะข้อร้องเรียน</span></a></li>
								<li><a href="users_list.php"><i class="icon-settings"></i><span> ข้อมูลผู้ใช้งาน</span></a></li>
								<li><a href="settings_update.php"><i class="icon-settings"></i><span> ข้อมูลการตั้งค่า</span></a></li>
								<li class="active"><a href="activities_list.php"><i class="icon-settings"></i><span> ข้อมูลกิจกรรม</span></a></li>
								<li><a href="articles_list.php"><i class="icon-settings"></i><span> ข้อมูลบทความ</span></a></li>
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
						<div class="col-md-12">
							<h3>เพิ่มข้อมูลกิจกรรม</h3>
						</div>
					</div><!-- /.row -->
					<form role="form" id="activities-add" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="ชื่อกิจกรรม" maxlength="100" name="activity-name" data-validation="required" data-validation-error-msg="บันทึกชื่อกิจกรรม">
							</div>
						</div>

                        <div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="รายละเอียดกิจกรรม"  name="activity-desc" data-validation="required" data-validation-error-msg="บันทึกรายละเอียดกิจกรรม">
							</div>
						</div>

                        <div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="สถานที่จัดกิจกรรม" maxlength="100" name="activity-place" data-validation="required" data-validation-error-msg="บันทึกสถานที่จัดกิจกรรม">
							</div>
						</div>
                            
                         <div class="col-md-6">
							<div class="form-group">
                                <p>วันเริ่มกิจกรรม</p>
								<input type="date" class="form-control"  name="activity-sdate" data-validation="required" data-validation-error-msg="บันทึกวันเริ่มกิจกรรม">
							</div>
						</div>
                           
                        <div class="col-md-6">
							 <div class="form-group">
                                <p>วันสิ้นสดกิจกรรม</p>
								<input type="date" class="form-control"  name="activity-edate" data-validation="required" data-validation-error-msg="บันทึกวันสิ้นสดกิจกรรม">
							 </div>
						</div>

                        <div class="col-md-6">
							 <div class="form-group">
								<!-- <input type="file" id= "activity-image" name="activity-image"> -->
								<label class="btn btn-info">
									อัพโหลดไฟล์ภาพ&hellip; <input type="file" id="activity-image" name="activity-image" style="display: none;">
            					</label>
                            </div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<div id="image_preview"></div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="เพิ่มข้อมูล" class="btn btn-primary btn-modify" name="activity-submit">
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
	<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="../js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<!-- Counters -->
	<script src="../js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="../js/main.js"></script>
	<!-- jQuery Form Validator -->
	<script src="../js/form-validator/jquery.form-validator.min.js"></script>
	<script>
		$.validate();
	</script>
    <script type="text/javascript">
    	$("#activity-image").change(function(){
    	    $('#image_preview').html("");
     	    var total_file=document.getElementById("activity-image").files.length;
     	    for(var i=0;i<total_file;i++) {
      		    $('#image_preview').append("<center><img src='"+URL.createObjectURL(event.target.files[i])+"' width='250' height='250'></center>");
     	    }
        });
    </script>
	</body>
</html>

