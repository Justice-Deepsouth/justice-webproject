<?php
	session_start();
	ob_start();

	include_once 'php/dbconnect.php';
	include_once 'php/user.php';

    // get connection
	$database = new Database();
	$db = $database->getConnection();

    // pass connection to property_types table
	$user = new User($db);

	// read all records
	$active = false;
	$result = $user->readall($active);
	$total_rows = $user->getTotalRows();

	if (isset($_POST['user-submit'])) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$user->user_id = $_POST['user-id'];
		$user->user_name = $_POST['user-name'];
		$user->user_passwd = $_POST['user-password_confirmation'];
		$user->user_email = $_POST['user-email'];
		$user->user_type = "1";
		$user->user_status = "1";

		if ($row['user_id'] != $_POST['user-id']) {
			if ($_POST['user-password_confirmation'] == $_POST['user-password']) {
				$user->user_passwd = $_POST['user-password_confirmation'];
				if ($user->create()) {
                    header("Location: index.php");
					$success = true;
					
				} else {
					$success = false;
				}
			} else {
				$success = false;
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
	<title>เพิ่มหน่วยงานยุติธรรม | Justice Project</title>
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
						<div id="fh5co-logo"><a href="index.php"><img src="images/logo_7.jpg"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.html">หน้าแรก</a></li>
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
							<li><a href="complaint_login.html">ร้องเรียน</a></li>
							<li><a href="about.html">เกี่ยวกับโครงการ</a></li>
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
				<div class="col-md-1 col-sm-2">
					
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-8 col-md-push-2 animate-box">
					<div class="row">
						<div class="col-md-12">
							<h3>เพิ่มหน่วยงานยุติธรรม</h3>
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
	<!-- jQuery Form Validator -->
	<script src="js/form-validator/jquery.form-validator.min.js"></script>
	<script>
		$.validate({
  			modules : 'security',
		});
	</script>

	</body>
</html>
