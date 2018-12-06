<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Justice Deep South Project</title>
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

	<!-- <style rel="stylesheet" type="text/css">
		#fh5co-logo {font-family: 'Chakra Petch', sans-serif;}
	</style> -->

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
							<li class="active"><a href="index.php">หน้าแรก</a></li>
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
			   	<li style="background-image: url(images/img_bg_1.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 slider-text">
				   				<div class="slider-text-inner">
				   					<h1>กรณีศึกษาการจัดการปัญหาความยุติธรรม#1</h1>
										<h2>ข้อความเกริ่นนำหรือบทสรุป ไม่เกิน 2 บรรทัด</h2>
										<p><a class="btn btn-primary btn-demo" href="#"> อ่านต่อ...</a></p>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_2.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-push-3 slider-text">
				   				<div class="slider-text-inner">
				   					<h1>กรณีศึกษาการจัดการปัญหาความยุติธรรม#2</h1>
										<h2>ข้อความเกริ่นนำหรือบทสรุป ไม่เกิน 2 บรรทัด</h2>
										<p><a class="btn btn-primary btn-demo" href="#"> อ่านต่อ...</a></p>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_3.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>กรณีศึกษาการจัดการปัญหาความยุติธรรม#3</h1>
										<h2>ข้อความเกริ่นนำหรือบทสรุป ไม่เกิน 2 บรรทัด</h2>
										<p><a class="btn btn-primary btn-demo" href="#"> อ่านต่อ...</a></p>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_4.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-push-3 slider-text">
				   				<div class="slider-text-inner">
				   					<h1>กรณีศึกษาการจัดการปัญหาความยุติธรรม#4</h1>
										<h2>ข้อความเกริ่นนำหรือบทสรุป ไม่เกิน 2 บรรทัด</h2>
										<p><a class="btn btn-primary btn-demo" href="#"> อ่านต่อ...</a></p>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>	   	
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-services">
			<div class="row">
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-diamond"></i>
						</span>
						<div class="desc">
							<h3><a href="#">ความรู้ด้านยุติธรรม#1</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-lab2"></i>
						</span>
						<div class="desc">
							<h3><a href="#">ความรู้ด้านยุติธรรม#2</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center animate-box">
					<div class="services">
						<span class="icon">
							<i class="icon-settings"></i>
						</span>
						<div class="desc">
							<h3><a href="#">ความรู้ด้านยุติธรรม#3</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-work" class="fh5co-light-grey">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
					<h2>ผลงานการแก้ปัญหาความยุติธรรมในพื้นที่</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 text-center animate-box">
					<a href="work-single.html" class="work"  style="background-image: url(images/portfolio-1.jpg);">
						<div class="desc">
							<h3>Project Name</h3>
							<span>Illustration</span>
						</div>
					</a>
				</div>
				<div class="col-md-4 text-center animate-box">
					<a href="work-single.html" class="work" style="background-image: url(images/portfolio-2.jpg);">
						<div class="desc">
							<h3>Project Name</h3>
							<span>Brading</span>
						</div>
					</a>
				</div>
				<div class="col-md-4 text-center animate-box">
					<a href="work-single.html" class="work" style="background-image: url(images/portfolio-3.jpg);">
						<div class="desc">
							<h3>Project Name</h3>
							<span>Illustration</span>
						</div>
					</a>
				</div>
			</div>
		</div>

		<!-- <div id="fh5co-counter" class="fh5co-counters">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center animate-box">
					<p>We have a fun facts far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="3452" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Cups of Coffee</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="234" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Client</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="6542" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Projects</span>
						</div>
						<div class="col-md-3 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="8687" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Done Projects</span>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<div id="fh5co-blog" class="blog-flex">
			<div class="featured-blog" style="background-image: url(images/blog-1.jpg);">
				<div class="desc-t">
					<div class="desc-tc">
						<span class="featured-head">Featured Posts</span>
						<h3><a href="#">Top 20 Best WordPress Themes 2017 Multi Purpose and Creative Websites</a></h3>
						<span><a href="#" class="read-button">Learn More</a></span>
					</div>
				</div>
			</div>
			<div class="blog-entry fh5co-light-grey">
				<div class="row animate-box">
					<div class="col-md-12">
						<h2>บทความล่าสุด</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<a href="#" class="blog-post">
							<span class="img" style="background-image: url(images/blog-2.jpg);"></span>
							<div class="desc">
								<h3>บทความล่าสุด 1</h3>
								<span class="cat">ประเภทบทความ</span>
							</div>
						</a>
					</div>
					<div class="col-md-12 animate-box">
						<a href="#" class="blog-post">
							<span class="img" style="background-image: url(images/blog-1.jpg);"></span>
							<div class="desc">
								<h3>บทความล่าสุด 2</h3>
								<span class="cat">ประเภทบทความ</span>
							</div>
						</a>
					</div>
					<div class="col-md-12 animate-box">
						<a href="#" class="blog-post">
							<span class="img" style="background-image: url(images/blog-3.jpg);"></span>
							<div class="desc">
								<h3>บทความล่าสุด 3</h3>
								<span class="cat">ประเภทบทความ</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div><!-- END container-wrap -->

	<div class="container-wrap">
		<footer id="fh5co-footer" role="contentinfo">
			<div class="row">
				<div class="col-md-3 fh5co-widget">
					<h4>ยุติธรรมคืออะไร?</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
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
						<li><a href="https://www.psu.ac.th/th/" target="_blank">มหาวิทยาลัยสงขลานครินทร์</a></li>
						<li><a href="http://huso.pn.psu.ac.th/th/" target="_blank">คณะมนุษยศาสตร์และสังคมศาสตร์ ม.อ.</a></li>
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

