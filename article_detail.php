<?php
	session_start();
	ob_start();

	include_once 'php/dbconnect.php';
	include_once 'php/article.php';

    // get connection
    $database = new Database();
	$db = $database->getConnection();

	$article = new Article($db);
	
    if (isset($_GET['ar_id'])) {
		$article->article_id = $_GET['ar_id'];
		$result = $article->readone();
		$row = mysqli_fetch_array($result);
		if ($row['article_id'] == "") {
			header("Location: article_list.php");
		}
	} else {
		header("Location: article_list.php");
	}
	$active = true;
	$Aresult = $article->readall($active);
	ob_end_flush();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>บทความ <?= $row['article_title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Justice Deep South Project" />
	<meta name="keywords" content="Justice, Deepsouth, Thailand, Prince of Songkla University" />
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
						<div id="fh5co-logo"><a href="index.php"><img src="images/logo2.png"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">หน้าแรก</a></li>
							<li class="has-dropdown active">
								<a href="article_list.php">บทความ</a>
								<ul class="dropdown">
								<?php while ($Arow = mysqli_fetch_array($Aresult)) { 
									echo "<li><a href='article.php?ar_id=" .  $Arow['article_id'] . "'>" .  $Arow['article_title'] . "</a></li>";
								} ?>
								</ul>
							</li>
							<li><a href="activities.php">กิจกรรม</a></li>
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
				   					<h1>บทความ</h1>
										<h2>เกี่ยวกับบทความ</h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>		   	
			  	</ul>
			</div>
		</aside>		
		<div id="fh5co-about">
			<div class="col-md-12">
				<h4><i class="icon-stopwatch"> <?php echo $row['created_date'];?></i></h4>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 heading-section">
				<h3><?php echo $row['article_title']; ?></h3>
					<?php echo $row['article_desc']; ?>
				</div>
			</div>
		</div>
	</div><!-- END container-wrap -->

	<div class="container-wrap">
		<footer id="fh5co-footer" role="contentinfo">
			<div class="row">
				<div class="col-md-3 fh5co-widget">
					<h4>ยุติธรรมคืออะไร?</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto
						culpa amet.</p>
				</div>
				<div class="col-md-3 col-md-push-1">
					<h4>บทความอื่นๆ (ลิงค์จากเว็บอื่น) </h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">บทความอื่นๆ 1</a></li>
						<li><a href="#">บทความอื่นๆ 2</a></li>
						<li><a href="#">บทความอื่นๆ 3</a></li>
						<li><a href="#">บทความอื่นๆ 4</a></li>
						<li><a href="#">ดูบทความทั้งหมด</a></li>
					</ul>
				</div>
	
				<div class="col-md-3 col-md-push-1">
					<h4>ลิงค์ที่เกี่ยวข้อง</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">ลิงค์ที่เกี่ยวข้อง 1</a></li>
						<li><a href="#">ลิงค์ที่เกี่ยวข้อง 2</a></li>
						<li><a href="#">ลิงค์ที่เกี่ยวข้อง 3</a></li>
						<li><a href="#">ลิงค์ที่เกี่ยวข้อง 4</a></li>
						<li><a href="#">ลิงค์ที่เกี่ยวข้อง 5</a></li>
					</ul>
				</div>
	
				<div class="col-md-3">
					<h4>ติดต่อโครงการ</h4>
					<ul class="fh5co-footer-links">
						<li>เลขที่ ถนน ตำบล อำเภอ จังหวัด รหัสไปรษณีย์</li>
						<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
						<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						<li><a href="">gettemplates.co</a></li>
					</ul>
				</div>
	
			</div>
	
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

	</body>
</html>
