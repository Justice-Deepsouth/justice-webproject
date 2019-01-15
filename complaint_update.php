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
	include_once 'php/complaint.php';
	include_once 'php/complaint_type.php';
	include_once 'php/article.php';
		
	// get connection
    $database = new Database();
	$db = $database->getConnection();

	$complaint = new Complaint($db);
	$complaint->complaint_id = $_GET['comp_id'];
	$result = $complaint->readone();
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$complaint_type = new Complaint_type($db);
	$active = true;
	$resulttype = $complaint_type->readall($active);

    // form is submitted
    if (isset($_POST['complaint-update-submit'])) {
        $complaint->complaint_id = $_GET['comp_id'];
		$complaint->complaint_title = $_POST['complaint-title'];
		$complaint->complaint_type_id = $_POST['complaint-type-id'];
		$complaint->complaint_desc = $_POST['complaint-desc'];
        // insert
		if ($complaint->update()) {
			$success = true;
			header("Location: complaint_status.php");
        } else {
            $success = false;
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
							<a href="article_list.php">บทความ</a>
								<?php if(mysqli_fetch_array($Aresult) == ""){
								}else{
								?> <ul class="dropdown">
										<?php while ($Arow = mysqli_fetch_array($Aresult)) { 
											echo "<li><a href='article.php?ar_id=" .  $Arow['article_id'] . "'>" .  $Arow['article_title'] . "</a></li>";
										} ?>
									</ul>
								<?php } ?>
							</li>
							<li><a href="activities_show.php">กิจกรรม</a></li>
							<li><a href="complaint_login.php">ร้องเรียน</a></li>
							<li class="active"><a href="about.php">เกี่ยวกับโครงการ</a></li>
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
							<h3>แก้ไขข้อร้องเรียน</h3>
						</div>
					</div><!-- /.row -->
					<form role="form" id="complaint" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" value="<?php echo $row['complaint_title']; ?>" maxlength="100" name="complaint-title" placeholder="หัวข้อร้องเรียน" data-validation="required" data-validation-error-msg="บันทึกหัวข้อร้องเรียน">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control" name="complaint-type-id" data-validation-allowing="range[1;100]" data-validation-error-msg="บันทึกประเภทข้อร้องเรียน">
								<?php
								 while ($rowtype = mysqli_fetch_array($resulttype)) {
									 if ($row['complaint_type_id'] == $rowtype['complaint_type_id']) {
										echo '<option value="'.$rowtype['complaint_type_id'].'" selected>'.$rowtype['complaint_type_desc'].'</option>
										';
									 } else {
										echo '<option value="' . $rowtype['complaint_type_id'] . '">'.$rowtype['complaint_type_desc'].'</option>
										';
									 }
								}
								?>
								</select>
							</div>
						</div>
						<div class="col-md-offset-7"></div>
                        <div class="col-md-12">
							<div class="form-group">
                            <textarea name="complaint-desc" class="form-control" id="" cols="30" rows="7" placeholder="รายละเอียดข้อร้องเรียน" data-validation="required" data-validation-error-msg="บันทึกรายละเอียดข้อร้องเรียน"><?php echo $row['complaint_desc']; ?></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="ยืนยันการแก้ไข" class="btn btn-primary btn-modify" name="complaint-update-submit">
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

