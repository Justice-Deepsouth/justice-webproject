<?php
	session_start();
	ob_start();

    if (isset($_SESSION['user_session_id']) && isset($_SESSION['user_type'])) {
		// only admin type can access
		if ($_SESSION['user_type'] != 0) {
			header("Location: ../index.php");
		}
	} else {
		header("Location: ../index.php");
	}

    include_once '../php/dbconnect.php';
	include_once '../php/setting.php';
	include_once '../php/article.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $setting = new Setting($db);

	// read all records
	$result = $setting->readone();
    $row = mysqli_fetch_array($result);

	if (isset($_POST['setting-submit'])) {
		$setting->project_name_th = $_POST['project-name-th'];
		$setting->project_name_en = $_POST['project-name-en'];
		$setting->project_address = $_POST['project-address'];
        $setting->project_phone = $_POST['project-phone'];
        $setting->project_email = $_POST['project-email'];
        $setting->project_website = $_POST['project-website'];
        $setting->project_twitter = $_POST['project-twitter'];
        $setting->project_facebook = $_POST['project-facebook'];
        $setting->project_youtube = $_POST['project-youtube'];
        $setting->complaint_id_last = $_POST['complaint-id-last'];
		if ($setting->update()) {
            $success = true;
            // after update seccessfully, display updated data
            $result = $setting->readone();
            $row = mysqli_fetch_array($result);
        } else {			
            $success = false;
		}	
	}

	// pass connection to property_types table
	$article = new Article($db);
	$active = true;
	$Aresult = $article->readall($active);

	// pass connection to settings table
	$Sresult = $setting->readone();
	$Srow = mysqli_fetch_array($Sresult);
	
	ob_end_flush();
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>หน้าแก้ไขข้อมูลการตั้งค่า | <?php echo $Srow['project_name_en']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Justice Deep South Project" />
	<meta name="keywords" content="Justice, Deepsouth, Thailand, Faculty of Humanities and Social Sciences, Prince of Songkla University" />
	<meta name="author" content="Justice League Team by FMS@PSU" />


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

	<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />

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
								<a href="../article_list.php">บทความ</a>
									<?php
									if($Aresult == ""){
									}else{
									?>
										<ul class="dropdown">
										<?php while ($Arow = mysqli_fetch_array($Aresult)) { 
											echo "<li><a href='../article_detail.php?ar_id=" .  $Arow['article_id'] . "'>" .  $Arow['article_title'] . "</a></li>";
										} ?>
										</ul>
									<?php
									}
									?>
							</li>
							<li><a href="../activities_show.php">กิจกรรม</a></li>
							<li><a href="../complaint_login.php">ร้องเรียน</a></li>
							<li class="has-dropdown"><a href="#">เกี่ยวกับโครงการ</a>
								<ul class="dropdown">
									<li><a href="../about.php">บทสรุปผู้บริหาร</a></li>
									<li><a href="#">รายชื่อโรงเรียนที่เข้าร่วมโครงการ</a></li>
								</ul>
							</li>
							<li><a href="../contact.php">ติดต่อ</a></li>
							<?php 
								if (!isset($_SESSION['user_session_id'])) {
									echo "<li><a href='../complaint_login.php'>เข้าสู่ระบบ</a></li>";
								} else {
									echo "<li class='has-dropdown'>";
									echo "<a href='#'>คุณ " .  $_SESSION['user_id'] . "</a>";
									echo "<ul class='dropdown'>";
									echo "<li><a href='../user_info.php'>ข้อมูลผู้ใช้งาน</a></li>";
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
				<li style="background-image: url(../images/DSC_9377.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text slider-text-bg">
				   				<div class="slider-text-inner text-center">
				   					<h1><span style="background-color:yellow">การจัดการข้อมูล</span></h1>
									<h2><span style="background-color:yellow">Data Management</span></h2>
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
								<li class="active"><a href="settings_update.php"><i class="icon-settings"></i><span> ข้อมูลการตั้งค่า</span></a></li>
								<li><a href="activities_list.php"><i class="icon-settings"></i><span> ข้อมูลกิจกรรม</span></a></li>
								<li><a href="articles_list.php"><i class="icon-settings"></i><span> ข้อมูลบทความ</span></a></li>
								<li><a href="complaint_summary.php"><i class="icon-settings"></i><span> รายงานข้อร้องเรียน</span></a></li>
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
						<div class="col-md-12">
							<h3>แก้ไขข้อมูลการตั้งค่า</h3>
						</div>
					</div><!-- /.row -->
					<form role="form" id="project-settings" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" maxlength="100" placeholder="ชื่อโครงการ (ไทย)" name="project-name-th" value="<?php echo $row['project_name_th']; ?>" data-validation="required" data-validation-error-msg="บันทึกชื่อโครงการ (ไทย)">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" maxlength="100" placeholder="่ชื่อโครงการ (English)" name="project-name-en" value="<?php echo $row['project_name_en']; ?>">
							</div>
                        </div>
                        <div class="col-md-12">
							<div class="form-group">
                                <textarea class="form-control" name="project-address" placeholder="ที่ตั้งโครงการ"><?php echo $row['project_address']; ?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="20" placeholder="หมายเลขโทรศัพท์" name="project-phone" value="<?php echo $row['project_phone']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="50" placeholder="อีเมลโครงการ" name="project-email" value="<?php echo $row['project_email']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="50" placeholder="เว็บไซต์โครงการ" name="project-website" value="<?php echo $row['project_website']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="50" placeholder="Facebook โครงการ" name="project-facebook" value="<?php echo $row['project_facebook']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="50" placeholder="YouTube โครงการ" name="project-youtube" value="<?php echo $row['project_youtube']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="50" placeholder="Twitter โครงการ" name="project-twitter" value="<?php echo $row['project_twitter']; ?>">
							</div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
                                <input type="text" class="form-control" maxlength="10" placeholder="รหัสข้อร้องเรียน" name="complaint-id-last" value="<?php echo $row['complaint_id_last']; ?>" data-validation="required" data-validation-error-msg="บันทึกรหัสข้อร้องเรียน">
							</div>
                        </div>
                        <div class="col-md-offset-6"></div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="บันทึกการเปลี่ยนแปลง" class="btn btn-primary btn-modify" name="setting-submit">
							</div>
						</div>
						
						<div class="col-md-12">
						<?php
                            if (isset($success)) {
    							if ($success) {
        							echo "<div class='alert alert-success text-center'>อัพเดตข้อมูลเรียบร้อยแล้ว</div>";
    							} else {
        							echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถอัพเดตข้อมูลได้</div>";
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
						<small class="block">&copy; 2018 <?php echo $Srow['project_name_en']; ?>. All Rights Reserved.</small> 
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
	<script src="../js/form-validator/jquery.form-validator.min.js"></script>
	<script>
		$.validate();
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130573850-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-130573850-1');
	</script>

	</body>
</html>