<?php
	session_start();
	ob_start();

    if (!isset($_SESSION['user_session_id'])) {
        header("Location: ../index.php");
	}

	include_once '../php/dbconnect.php';
	include_once '../php/user.php';
	include_once '../php/article.php';

    // get connection
	$database = new Database();
	$db = $database->getConnection();

    // pass connection to property_types table
	$user = new User($db);

/* 	// read all records
	$active = false;
	$result = $user->readall($active);
	$total_rows = $user->getTotalRows();

	if (isset($_POST['user-submit'])) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$user->user_id = $_POST['user-id'];
		$user->user_name = $_POST['user-name'];
		$user->user_passwd = $_POST['user-password_confirmation'];
		$user->user_email = $_POST['user-email'];
		$user->user_organization = $_POST['user-organization'];
		$user->user_type = $_POST['user-type'];
		$user->user_status = $_POST['user-status'];

		if ($row['user_id'] != $_POST['user-id']) {
			if ($_POST['user-password_confirmation'] == $_POST['user-password']) {
				$user->user_passwd = $_POST['user-password_confirmation'];
				if ($user->create()) {
					$success = true;
					header("Location: users_list.php");
				} else {
					$success = false;
				}
			} else {
				$success = false;
			}
		}
	} */

	// Aj.Ruchdee
	if (isset($_POST['user-submit'])) {
		$user->user_id = $_POST['user-id'];
		if ($user->checkDuplicateUser()) {
			# user_id already exists
			$success = false;
			$duplicate = true;
		} else {
			# user_id inexists
			$user->user_name = $_POST['user-name'];
			$user->user_passwd = $_POST['user-password_confirmation'];
			$user->user_email = $_POST['user-email'];
			$user->user_organization = $_POST['user-organization'];
			$user->user_type = $_POST['user-type'];
			$user->user_status = $_POST['user-status'];
			if ($user->create()) {
				$success = true;
				header("Location: users_list.php");
			} else {
				$success = false;
			}
		}
	}

	// pass connection to property_types table
	$article = new Article($db);
	$active = true;
	$Aresult = $article->readall($active);
	
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
						<div id="fh5co-logo"><a href="../index.php"><img src="../images/logo_7.jpg"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="../index.php">หน้าแรก</a></li>
							<li class="has-dropdown">
							<a href="../article_list.php">บทความ</a>
								<?php if(mysqli_fetch_array($Aresult) == ""){
								}else{
								?> <ul class="dropdown">
										<?php while ($Arow = mysqli_fetch_array($Aresult)) { 
											echo "<li><a href='../article.php?ar_id=" .  $Arow['article_id'] . "'>" .  $Arow['article_title'] . "</a></li>";
										} ?>
									</ul>
								<?php } ?>
							</li>
							<li><a href="../activities_show.php">กิจกรรม</a></li>
							<li><a href="../complaint_login.php">ร้องเรียน</a></li>
							<li><a href="../about.php">เกี่ยวกับโครงการ</a></li>
							<li><a href="../contact.php">ติดต่อ</a></li>
							<?php 
								if (!isset($_SESSION['user_session_id'])) {
									echo "<li><a href='../complaint_login.php'>เข้าสู่ระบบ</a></li>";
								} else {
									echo "<li class='has-dropdown'>";
									echo "<a href='#'>คุณ " .  $_SESSION['user_id'] . "</a>";
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
								<li  class="active"><a href="users_list.php"><i class="icon-settings"></i><span> ข้อมูลผู้ใช้งาน</span></a></li>
								<li><a href="settings_update.php"><i class="icon-settings"></i><span> ข้อมูลการตั้งค่า</span></a></li>
								<li><a href="activities_list.php"><i class="icon-settings"></i><span> ข้อมูลกิจกรรม</span></a></li>
								<li><a href="articles_list.php"><i class="icon-settings"></i><span> ข้อมูลบทความ</span></a></li>
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
						<div class="col-md-12">
							<h3>เพิ่มผู้ใช้งาน</h3>
						</div>
					</div><!-- /.row -->
					<form role="form" id="users" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="รหัสผู้ใช้งาน" maxlength="20" name="user-id" data-validation="required" data-validation-error-msg="บันทึกรหัสผู้ใช้งาน">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" maxlength="100" name="user-name" data-validation="required" data-validation-error-msg="บันทึกชื่อผู้ใช้งาน">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="อีเมล" maxlength="50" name="user-email" data-validation="email" data-validation-error-msg="บันทึกอีเมล">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="หน่วยงาน/โรงเรียน" maxlength="200" name="user-organization" data-validation="required" data-validation-error-msg="บันทึกหน่วยงาน/โรงเรียน">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="password" class="form-control" placeholder="รหัสผ่าน"  maxlength="8" name="user-password_confirmation" data-validation="required" data-validation-error-msg="บันทึกรหัสผ่าน">
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" maxlength="8" name="user-password" data-validation="confirmation" data-validation-error-msg="ยืนยันรหัสผ่านไม่ถูกต้อง">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select class="form-control" name="user-type" data-validation="required">
									<option value="2" selected>ผู้ร้องเรียน</option>
									<option value="1">หน่วยงานยุติธรรม</option>
                                    <option value="0">ผู้ดูแลระบบ</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" class="form-control" name="user-status" value="1" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="เพิ่มข้อมูล" class="btn btn-primary btn-modify" name="user-submit">
							</div>
						</div>
						<div class="col-md-12">
						<?php
							if (isset($success)) {
								if ($success) {
									echo "<div class='alert alert-success text-center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
								} else {
									if ($duplicate) {
										echo "<div class='alert alert-danger text-center'>รหัสผู้ใช้งานซ้ำ! ไม่สามารถบันทึกข้อมูลได้</div>";
									} else {
										echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้</div>";
									}
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
		$.validate({
  			modules : 'security',
		});
	</script>

	</body>
</html>

