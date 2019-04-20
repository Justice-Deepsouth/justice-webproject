<?php
	session_start();
	ob_start();

	include_once 'php/dbconnect.php';
	include_once 'php/activity.php';
	include_once 'php/article.php';
	include_once 'php/setting.php';

	// get connection
	$database = new Database();
	$db = $database->getConnection();

	// pass connection to property_types table
	$article = new Article($db);
	$active = true;
	$Aresult = $article->readall($active);

	// pass connection to settings table
	$setting = new Setting($db);
	$Sresult = $setting->readone();
	$Srow = mysqli_fetch_array($Sresult);

// pass connection to property_types table
$activity = new Activity($db);
$active = true;
$data = $activity->readall($active);
$total_rows = $activity->getTotalRows();
$results_per_page = 10;
// determine number of total pages available
			$number_of_pages = ceil($total_rows / $results_per_page);
// determine which page number visitor is currently on
			if (!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = $_GET['page'];
			}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

	ob_end_flush();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>หน้ารวมกิจกรรม | <?php echo $Srow['project_name_en']; ?></title>
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

	<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

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
							<li class="has-dropdown">
								<a href="article_list.php">บทความ</a>
									<?php
											if($Aresult == ""){
											}else{
											?>
												<ul class="dropdown">
												<?php while ($Arow = mysqli_fetch_array($Aresult)) { 
													echo "<li><a href='article_detail.php?ar_id=" .  $Arow['article_id'] . "'>" .  $Arow['article_title'] . "</a></li>";
												} ?>
												</ul>
											<?php
											}
									?>
							</li>
							<li class="active"><a href="activities_show.php">กิจกรรม</a></li>
							<li><a href="complaint_login.php">ร้องเรียน</a></li>
							<li class="has-dropdown"><a href="#">เกี่ยวกับโครงการ</a>
								<ul class="dropdown">
									<li><a href="about.php">บทสรุปผู้บริหาร</a></li>
									<li><a href="#">รายชื่อโรงเรียนที่เข้าร่วมโครงการ</a></li>
								</ul>
							</li>
							<li><a href="contact.php">ติดต่อ</a></li>
							<?php 
								if (!isset($_SESSION['user_session_id'])) {
									echo "<li><a href='complaint_login.php'>เข้าสู่ระบบ</a></li>";
								} else {
									echo "<li class='has-dropdown'>";
									echo "<a href='#'>คุณ " . $_SESSION['user_id'] . "</a>";
									echo "<ul class='dropdown'>";
									echo "<li><a href='user_info.php'>ข้อมูลผู้ใช้งาน</a></li>";
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
    
		<div id="fh5co-blog">
                
		<div class="row">

		<center><h2>กิจกรรม</h2></center>
			<?php while ($row = mysqli_fetch_array($data)) { ?>

				<div class="col-md-4">
					<div class="fh5co-blog animate-box">
                        <?php 
						if ($row['activity_image'] != "") {
							echo "<a href='#' class='blog-bg' style='background-image: url(activity_img/$row[activity_image])'></a>";
						} else {
							echo "<a href='#' class='blog-bg' style='background-image: url(images/no_image.jpg)'></a>";
						}
						?>
						<div class="blog-text">
							<i class="icon-calendar"></i> &nbsp;
						<?php 
						$row['activity_sdate'];
						$strDat = $row['activity_sdate'];
						$sDate = $activity->DateThai($strDat);
						echo $sDate;
						?>
					-
					 <?php 
					$row['activity_edate'];
					$strDat = $row['activity_edate'];
					$eDate = $activity->DateThai($strDat);
					echo $eDate;
					?>
							<h3><a href="activities_detail.php?activity_id=<?php echo $row['activity_id']; ?>"><?php echo $row["activity_name"]; ?></a></h3>
							<p><?php 
									$desc = $row["activity_desc"];
									$detail = substr($desc, 0, 30);
									echo $detail;
									?></p>
							<ul class="stuff">

								<li><a href="activities_detail.php?activity_id=<?php echo $row['activity_id']; ?>">รายละเอียดเพิ่มเติม<i class="icon-arrow-right22"></i></a></li>
							</ul>
						</div> 
					</div>
				</div>

            <?php } ?>

	</div>
	<center><?php
							
							// display the links to the pages
					for ($page = 1; $page <= $number_of_pages; $page++) {
						echo '
						<ul class="pagination">
							<li><a href="activities_show.php?page=' . $page . '">' . $page . '</a></li>					
						</ul>';
					}
							// exit(0);
					?></center>
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
					<h4>กิจกรรมที่ผ่านมา (อัลบั้มภาพ) </h4>
					<ul class="fh5co-footer-links">
					<li><a href="gallery/09-11-2017/">กิจกรรมวันที่ 9 พ.ย. 2560</a></li>
						<li><a href="#">บทความอื่นๆ 2</a></li>
						<li><a href="#">บทความอื่นๆ 3</a></li>
						<li><a href="#">บทความอื่นๆ 4</a></li>
						<li><a href="#">ดูบทความทั้งหมด</a></li>
					</ul>
				</div>

				<div class="col-md-3 col-md-push-1">
					<h4>ลิงค์ที่เกี่ยวข้อง</h4>
					<ul class="fh5co-footer-links">
						<li><a href="https://www.moj.go.th/" target="_blank">กระทรวงยุติธรรม</a></li>
						<li><a href="https://www.psu.ac.th/th/" target="_blank">มหาวิทยาลัยสงขลานครินทร์</a></li>
						<li><a href="http://huso.pn.psu.ac.th/th/" target="_blank">คณะมนุษยศาสตร์และสังคมศาสตร์</a></li>
					</ul>
				</div>

				<div class="col-md-2">
				</div>

			</div>

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