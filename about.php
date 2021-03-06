<?php 
	session_start();
	ob_start();

	include_once 'php/dbconnect.php';
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

	ob_end_flush();
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>บทสรุปผู้บริหาร | <?php echo $Srow['project_name_en']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Justice Deep South Project" />
	<meta name="keywords" content="Justice, Deepsouth, Thailand, Prince of Songkla University" />
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

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	
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
		<!-- Theme style  -->
		<!-- <link rel="stylesheet" href="css/1.css"> -->

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
							<li><a href="activities_show.php">กิจกรรม</a></li>
							<li><a href="complaint_login.php">ร้องเรียน</a></li>
							<li class="has-dropdown active"><a href="#">เกี่ยวกับโครงการ</a>
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
			   	<li style="background-image: url(images/IMG_7800.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text slider-text-bg">
				   				<div class="slider-text-inner text-center">
				   					<h1><span style="background-color:yellow">เกี่ยวกับโครงการ</span></h1>
									<h2><span style="background-color:yellow">ใส่ Quote เกี่ยวกับความยุติธรรม</span></h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>		   	
			  	</ul>
		  	</div>
		</aside>		
		<div id="fh5co-about">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center heading-section">
					<h3>บทสรุปผู้บริหาร [Executive Summary]</h3>
					<p class="text-justify">&emsp; &emsp; กระทรวงยุติธรรมร่วมกับคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี จัดทำโครงการวิจัยเชิงปฏิบัติการสร้างความเป็นธรรมโดยกระบวนการยุติธรรม กรณีโรงเรียนเอกสารสอนศาสนาอิสลามในจังหวัดชายแดนภาคใต้ เพื่อขับเคลื่อนงานด้านกระบวนการยุติธรรมในจังหวัดชายแดนภาคใต้ โดยใช้รากฐานทางวัฒนธรรมเป็นปัจจัยสำคัญในการขับเคลื่อน และดำเนินงานตามแนวทางความเสมอภาคทางโอกาส การมีส่วนร่วม และสิทธิมนุษยชน โดยเน้นการทำงานที่ </p>
					<ol type=”1″>
						<li><p class="text-justify">สร้างความเข้าใจ การเห็นคุณค่า และการปฏิบัติงานด้านความหลากหลายของผู้คน เพื่อให้เกิดความยุติธรรมและการมีส่วนร่วมอย่างเต็มที่ในการสร้างความเป็นธรรมในพื้นที่ชายแดนใต้</p></li>		
						<li><p class="text-justify">การส่งเสริมความเสมอภาคทางโอกาส รวมถึงการทำแบบประเมินผลกระทบ และการคัดกรองความเสมอภาคเชิงนโยบาย การทำงาน และแผนการดำเนินงานด้านความหลากหลาย</p></li>
						<li><p class="text-justify">เน้นการทำงานและปฏิบัติกับผู้ร่วมงานอย่างเท่าเทียม ให้เกียรติ และความเคารพ เพื่อกระตุ้นให้นักรียน และครูอาจารย์เกิดความเข้าใจและนำไปใช้ได้จริงในชีวิตประจำวัน</p></li>
						<li><p class="text-justify">เน้นการสร้างแนวคิดเพื่อขจัดการเลือกปฏิบัติ และอุปสรรค พร้อมทั้งสร้างความสมดุล ความเสมอภาคในสังคมชายแดนใต้</p></li>
					</ol>
					<p class="text-justify">&emsp; &emsp; นอกจากนั้นโครงการฯนี้ ยังมีเป้าหมายสำคัญ คือ การเกิดศูนย์ยุติธรรมชุมชนในโรงเรียนเอกชนสอนศาสนาอิสลาม ที่ก่อตั้ง โดยผู้บริหาร ครู และนักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลาม บริหารงานโดยบุคลากรในโรงเรียนเอกชนสอนศาสนาอิสลาม และคนในชุมชน ทำงานเพื่อคนในชุมชน โดยมีหน่วยงานของกระทรวงยุติธรรมเป็นฝ่ายสนับสนุน การดำเนินงานตามโครงการฯ ได้ยึดเป้าหมายและภารกิจต่างๆ ที่กล่าวมาข้างต้นนี้ ซึ่งสามารถแจกแจงกระบวนการดำเนินงานที่ผ่านมาได้ดังนี้</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 animate-box">
					<img src="images/about1.png" width="640" height="640" class="img-fluid" alt="Responsive image">
			<div class="about-desc">	
			<br>

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#step-1">ขั้นตอนที่ 1</a></li>
						<li><a data-toggle="tab" href="#step-2">ขั้นตอนที่ 2</a></li>
						<li><a data-toggle="tab" href="#step-3">ขั้นตอนที่ 3</a></li>
						<li><a data-toggle="tab" href="#step-4">ขั้นตอนที่ 4</a></li>
						<li><a data-toggle="tab" href="#step-5">ขั้นตอนที่ 5</a></li>
					  </ul>
					  <div class="tab-content">
						<div id="step-1" class="tab-pane fade in active">
							<br>
							<h4>ขั้นตอนที่ 1 การเผยแนวคิดยุติธรรมสู่ประชาชน </h4>
							<p class="text-justify">&emsp; &emsp; ภายใต้กระบวนการศึกษา จะยึดแนวทางการมีส่วนร่วมและการบูรณาการภายใต้บริบทของชุมชนเป็นหลัก ซึ่งพบว่าวิธีการส่งเสริมหรือเผยแพร่ความรู้ และกิจกรรมต่างๆ ที่เกี่ยวข้องกับงานยุติธรรม การทำงานของโครงการได้เน้นการเผยแพร่แนวคิดการทำงานทางด้านยุติธรรมชุมชน และการสร้างเครือข่ายยุติธรรมโรงเรียนเอกชนสอนศาสนาอิสลาม และชุมชนสู่กลุ่มต่างๆในพื้น สามารถจำแนกออกเป็น 4 ระดับ คือ</p>
							<img src="images/about2.png" width="640" height="640" class="img-fluid" alt="Responsive image">
							<br><br>
							<ol type=”1″>
						<li>
							<h5>เครือข่ายโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด</h5>
							<p class="text-justify">&emsp; &emsp;ในพื้นที่ทั้งสามจังหวัด จะมีกลุ่มกรรมการโรงเรียนเอกชนสอนศาสนาอิสลาม ในแต่ละจังหวัด โดยในคณะกรรมการนั้นจะมาจากผู้นำศาสนาในแต่ละอำเภอภายในจังหวัดนั้นๆ ประกอบกับกรรมการที่มีความรู้ความเชียวชาญในแต่ละด้าน ซึ่งส่วนใหญ่จะเป็นผู้ที่คนในพื้นที่ให้การยอมรับ ดังนั้นการเผยแพร่ ส่งเสริม ความรู้ทางด้านกระบวนการยุติธรรมผ่านกลุ่มคนเหล่านี้ จึงมีความจำเป็นอย่างมาก เนื่องจากบุคคลเหล่านี้มีความพร้อมที่จะเรียนรู้ และมีความสามารถที่จะเผยแพร่ความรู้สู่ชุมชนภายในพื้นที่ การสร้างความตระหนักและการพัฒนาศักยภาพของคณะกรรมการเครือข่ายยุติธรรมตาดีกาสัมพันธ์ในแต่ละจังหวัดจึงมีความสำคัญอย่างมาก</p>
						</li>		
						<li>
							<h5>กรรมการในสมาคมครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด</h5>
							<p class="text-justify">&emsp; &emsp;ในแต่ละจังหวัดจะมีสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.) อยู่ และมีสมาคมโรงเรียนเอกชาสอนศาสนาอิสลาม ซึ่งสมาชิกในสมาคมมาจากผู้บริหาร และคณะครูสอนโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด โดยส่วนใหญ่จำนวนสมาชิกของสมาคมจะขึ้นอยู่กับจำนวนโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด การติดต่อหรือการประสานงานภายในจังหวัดถ้าผ่านทางสมาคมจะทำให้การประสานสำเร็จได้ด้วยดี ดังนั้นในการเผยแพร่ความรู้ความเข้าใจทางด้านงานยุติธรรม ถ้าผ่านทางเครือข่ายสมาคมครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละอำเภอ และให้สมาชิกเผยแพร่สู่ประชาชนในหมู่บ้านต่างๆ ภายในตำบลของตน การส่งเสริมการคุ้มครองสิทธิและเสรีภาพก็อาจจะสำเร็จอีกในระดับหนึ่ง</p>
						</li>	
						<li>
							<h5>การเผยแพร่สู่ครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละโรงเรียน</h5>
							<p class="text-justify">&emsp; &emsp;การติดต่อ หรือการเชิญผู้บริหาร และครูโรงเรียนเอกชนสอนศาสนาอิสลาม ในแต่ละโรงเรียนจะประสานผ่านสมาชิกสมาคมโรงเรียนเอกชนสอนศาสนาอิสลาม และสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.)  เนื่องจากสมาชิกแต่ละคนจะมีความคุ้นเคยกับโรงเรียนในพื้นที่สามารถประสานงานได้ง่าย และสะดวกกว่า การเผยแพร่ในระดับนี้จะเป็นการสร้างความรู้ความเข้าใจให้กับผู้บริหาร และครูในโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัดเพื่อให้เกิดความตระหนักและเห็นถึงความสำคัญของสิทธิและเสรีภาพ อันจะนำไปสู่การเผยแพร่สู่คนในหมู่บ้านต่อไป</p>
						</li>	
						<li>
							<h5>การเผยแพร่ในโรงเรียนเอกชนสอนศาสนาอิสลาม</h5>
							<p class="text-justify">&emsp; &emsp;การเผยแพร่ความรู้ ความเข้าใจในด้านสิทธิและเสรีภาพสู่กลุ่ม เด็กและเยาวชนที่ศึกษาอยู่ในโรงเรียนเอกชนสอนศาสนาอิสลาม มีความสำคัญเป็นอย่างมาก การจัดทำหลักสูตรในโครงการนี้จะนำร่องเผยแพร่ ในโรงเรียนเอกชนสอนศาสนาอิสลามที่กรรมการสมาคมโรงเรียนเอกชนสอนศาสนาอิสลาม และสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.) ในแต่ละจังหวัด เป็นเจ้าของหรือสอนอยู่ก่อนเป็นอันดับแรก โดยจะให้ความรู้ในกลุ่มครูก่อน จากนั้นจะเผยแพร่สู่กลุ่มนักเรียน และผู้ปกครอง </p>
						</li>	
	
					</ol>
						</div>
						<div id="step-2" class="tab-pane fade">
						<br>
							<h4>ขั้นตอนที่ 2 การสำรวจปัญหาและความต้องการความเป็นธรรมในกระบวนการยุติธรรมของนักเรียน และบุคลากรโรงเรียนเอกชนสอนศาสนาอิสลามในจังหวัดชายแดนใต้</h4>
							<p class="text-justify">&emsp; &emsp; การวิเคราะห์และประมวลผลจากแบบสำรวจปัญหาและความต้องการความเป็นธรรมในกระบวนการยุติธรรมของผู้บริหาร ครูเกี่ยวกับบทบาททางสังคมในชุมชนพบว่า ผู้บริหาร ครูส่วนใหญ่ ไม่มีบทบาททางสังคมหรือในชุมชน  จำนวน 98 คน คิดเป็นร้อยละ 68.5 ของกลุ่มประชากรทั้งหมด ซึ่งถือเป็นสัดส่วนที่มีจำนวนมากที่สุดในขณะที่สิ่งที่ต้องการพัฒนา พบว่าผู้บริหาร ครูส่วนใหญ่สนใจและต้องการพัฒนาด้านภาษาจำนวน 97 คน คิดเป็นร้อยละ 45.12 ซึ่งถือเป็นสัดส่วนที่มากที่สุด ในขณะที่เป็นที่น่าสังเกตว่าความต้องการพัฒนาทักษะการเจรจาไกล่เกลี่ยนั้นน้อยที่สุด จำนวน 47 คน คิดเป็นร้อยละ 21.86 ซึ่งควรมีการศึกษาในเชิงรายละเอียดเพิ่มเติมเกี่ยวกับสาเหตุในความต้องการในเรื่องทักษะดังกล่าวว่าเหตุใดจึงน้อยที่สุด และควรมีการหาแนวทางในการเพิ่มเติมข้อมูล องค์ความรู้เกี่ยวกับกระบวนการยุติธรรม สิทธิมนุษยชน โดยเฉพาะการออกแบบเชิงกระบวนการเพื่อสร้างการเข้าถึงข้อมูลความรู้ดังกล่าว  </p>
						</div>
						<div id="step-3" class="tab-pane fade">	
							<br>
							<h4>ขั้นตอนที่ 3 การจัดทำหลักสูตรการพัฒนาความรู้</h4>
							<p class="text-justify">&emsp; &emsp; ในขั้นตอนนี้คณะผู้ดำเนินการจึงได้มีการศึกษาแนวคิด ทฤษฎี และงานวรรณกรรมที่เกี่ยวข้อง (ปรากฏอยู่ในรายงานงวดที่ 1) และได้นำผลการศึกษา จากผลการวิเคราะห์ สังเคราะห์เกี่ยวกับการสร้างความเป็นธรรมด้วยกระบวนการยุติธรรมให้เกิดขึ้นในโรงเรียนเอกชนสอนศาสนาอิสลามในพื้นที่สามจังหวัดชายแดนภาคใต้ให้เกิดขึ้นอย่างเป็นรูปธรรมภายใต้ความร่วมมือและการมีส่วนร่วมของทุกฝ่าย และควรจัดอบรมเสริมสร้างความเข้าใจในเรื่องนี้ในองค์ความรู้ทางด้านสิทธิเสรีภาพ และความยุติธรรมให้เกิดความสมบูรณ์จึงนำมาสู่การร่างหลักสูตร “การสร้างสันติด้วยความเป็นธรรมภายใต้กระบวนการยุติธรรมในจังหวัดชายแดนภาคใต้”โดยมีรายละเอียดดังนี้</p>
							<h5>เรื่องที่ 1 สิทธิเสรีภาพ และศักดิ์ศรีความเป็นมนุษย์</h5>
								<ol type=”1″>
									<li><p class="text-justify">ฐานแนวคิดในการกำหนดสิทธิมนุษยชน</p></li>		
									<li><p class="text-justify">สิทธิเสรีภาพ และศักดิ์ศรีความเป็นมนุษย์ที่รองรับไว้ในรัฐธรรมนูญ</p></li>
								</ol>
							<h5>เรื่อง 2 สิทธิเสรีภาพตามหลักการอิสลามกับวิถีชีวิต</h5>
								<ol type=”1″>
									<li><p class="text-justify">การสร้างฐานความเข้าใจสิทธิตามหลักการอิสลาม </p></li>		
									<li><p class="text-justify">สิทธิเสรีภาพ และกระบวนการยุติธรรม กับ จารีตวัฒนธรรมตามวิถีอิสลาม</p></li>
								</ol>
								<h5>เรื่องที่ 3 กฎหมายกับสถานการณ์ปัญหาในพื้นที่</h5>
								<ol type=”1″>
									<li><p class="text-justify">พระราชกำหนดว่าด้วยการบริหารงานในสถานการณ์ฉุกเฉิน พ.ศ. 2548</p></li>		
									<li><p class="text-justify">พระราชบัญญัติค่าตอบแทนผู้เสียหายและค่าทดแทน และค่าใช้จ่ายแก่จำเลยในคดีอาญา พ.ศ. 2544</p></li>
								</ol>
								<h5>เรื่องที่ 4	 องค์กรและกลไกการคุ้มครองสิทธิและเสรีภาพ</h5>
								<ol type=”1″>
									<li><p class="text-justify">กระทรวงยุติธรรม</p></li>		
									<li><p class="text-justify">คณะกรรมการสิทธิมนุษยชนแห่งชาติ</p></li>
									<li><p class="text-justify">สำนักงานผู้ตรวจการแผ่นดินของรัฐสภา</p></li>		
									<li><p class="text-justify">ศาลปกครอง</p></li>
									<li><p class="text-justify">ศาลยุติธรรม</p></li>		
									<li><p class="text-justify">ศาลรัฐธรรมนูญ</p></li>
								</ol>	
						</div>
						<div id="step-4" class="tab-pane fade">
							<br>
							<h4>ขั้นตอนที่ 4 การส่งเสริมและพัฒนาเครือข่ายโรงเรียนเอกชนสอนศาสนาอิสลาม </h4>
							<p class="text-justify">&emsp; &emsp; มีการดำเนินงานโดยสามารถแบ่งกิจกรรมการส่งเสริมออกเป็นกิจกรรมต่างๆ ได้ดังนี้</p>
							<img src="images/about3.png" width="640" height="640" class="img-fluid" alt="Responsive image">
							<br><br>
							<ol type="I">
								<li>
									<h5>กิจกรรมที่ 1 การพัฒนาฐานความรู้ </h5>
									<p class="text-justify">&emsp; &emsp; ตามหลักสูตร “การสร้างสันติด้วยความเป็นธรรมภายใต้กระบวนการยุติธรรมในจังหวัดชายแดนภาคใต้” โดยมีผู้อบรม 2 กลุ่ม ประกอบด้วย</p>
									<ol type=”1″>  <!-- ข้อย่อย -->
										<li>
											<p class="text-justify">คณะกรรมการร่างหลักสูตร ครู (อุสตาซ) ที่สอนในโรงเรียนเอกชนสอนศาสนาอิสลาม ในพื้นที่ จังหวัดยะลา ปัตตานี และจังหวัดนราธิวาส จำนวน 63 คน </p>
										</li>		
										<li>
											<p class="text-justify">นักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลาม ในพื้นที่ จังหวัดยะลา ปัตตานี และจังหวัดนราธิวาส จำนวน 138 คน</p>
										</li>	
									</ol> <!-- ข้อย่อย -->

									</li>		
								<li>
									<h5>กิจกรรมที่ 2 การจัดเวทีแลกเปลี่ยนและวางโครงสร้างเครือข่ายยุติธรรมโรงเรียนเอกชนสอนศาสนาอิสลาม </h5>
									<p class="text-justify">&emsp; &emsp;เป็นแนวทางการส่งเสริมที่ต่อเนื่องจากการอบรม เวทีประชาคมจะช่วยให้ครูและนักเรียนได้เกิดกระบวนการเรียนรู้ เนื่องจากได้นำสิ่งที่ได้รับจากการพัฒนาความรู้มาวางแผนร่วมกันเพื่อจะนำไปสู่การปฏิบัติ ในรูปแบบการคุ้มครองสิทธิและเสรีภาพของชุมชน การดำเนินงานจะใช้เครือข่ายเป็นแกนหลักในการดำเนินการ วางแผน ระดมความคิด และสร้างโครงสร้างการทำงานเป็นเครือข่ายในชุมชนซึ่งการจัดเวทีแลกเปลี่ยนจะต้องมีการทำอย่างต่อเนื่อง </p>
								</li>	
								<li>
									<h5>กิจกรรมที่ 3 การเผยแพร่ความรู้ผ่านสื่อและสื่อ Social Media</h5>
									<p class="text-justify">&emsp; &emsp;เป็นช่องทางการสื่อสารหนึ่งที่มีประสิทธิภาพและเข้าถึงครูและนักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลาม การที่จะส่งเสริมให้ครูและนักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลามได้รับรู้เรื่องสิทธิเสรีภาพและกฎหมายเบื้องต้นนั้น ช่องทางหนึ่งที่คิดว่าสามารถช่วยให้ครูและนักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลามได้รับรู้และเป็นสื่อกลางในการเผยแพร่สู่กลุ่มต่างในพื้นที่จังหวัดชายแดนใต้</p>
								</li>	
								<li>
									<h5>กิจกรรมที่ 4 การผลิตหนังสือกฎหมาย / สื่อแผ่นพับ / โปสเตอร์</h5>
									<p class="text-justify">&emsp; &emsp;การรับรู้ด้วยการอ่านหนังสือถือเป็นวิธีการรับรู้ที่ประชาชนสามารถแสวงหาความรู้ให้กับตนเองได้ตลอดเวลา เหมือนมีที่ปรึกษาอยู่กับตัวเอง ฉะนั้นเครื่องมือการเรียนรู้ คือตำรา หรือหนังสือที่เป็นความรู้เกี่ยวกับสิทธิเสรีภาพและกฎหมายเบื้องต้นที่จะช่วยให้ชาวบ้านเกิดความรู้ และปกป้องสิทธิของตนเองจึงมีความสำคัญมาก ดังนั้นเครือข่ายยุติธรรมตาดีกาสัมพันธ์ จึงมีความเห็นร่วมกันว่าน่าจะมีหนังสือหรือสื่อต่าง ๆ แจกไว้เป็นคู่มือแก่ประชานบ้าง ซึ่งจะต้องมีการแปลเอกสารเหล่านั้นเป็น 2 ภาษา คือ ภาษาไทย และภาษามลายู </p>
								</li>	
								<li>
									<h5>กิจกรรมที่ 5 การพูดคุยกับคนในชุมชนตามโรงเรียนเอกชนสอนศาสนาอิสลามหรือมัสยิดต่างๆ</h5>
									<p class="text-justify">&emsp; &emsp;การจะทำให้ประชาชนเกิดการเรียนรู้เรื่องสิทธิเสรีภาพและกฎหมายเบื้องต้นนั้น วิธีการหนึ่งที่ประชาชนสะดวกและมีประโยชน์มาก คือ การนั่งพูดคุยกันตามชุมชนตามมัสยิดต่างๆ โดยเฉพาะในวันศุกร์ ซึ่งจะได้เข้าถึง และเกิดความคุ้นเคยกับชุมชน การส่งเสริมความรู้ความเข้าใจในการคุ้มครองสิทธิก็จะง่ายขึ้น และสามารถปรับให้เข้ากับวิถีชีวิตของชาวมุสลิมได้ง่ายขึ้น</p>
								</li>
							</ol>
					</div>
				
					
						<div id="step-5" class="tab-pane fade">
						<br>
							<h4>ขั้นตอนที่ 5 ระบบการคุ้มครองและเยียวยางานทางด้านกระบวนการยุติธรรม</h4>
							<p class="text-justify">&emsp; &emsp; โดยใช้กิจกรรมการสร้างความเป็นธรรมร่วมกับหน่วยงานในกระบวนการยุติธรรม ในการดำเนินงานโครงสร้างการคุ้มครองและเยียวยางานทางด้านกระบวนการยุติธรรมปัจจัยที่สำคัญประการหนึ่งคือระบบการสนับสนุนของหน่วยงานภาครัฐ ทางผู้ดำเนินงานจึงได้วางแผนร่วมกับสำนักงานยุติธรรมทั้ง 3 จังหวัด ประกอบด้วย จังหวัดนราธิวาส, จังหวัดยะลา และจังหวัดปัตตานี และยังวางแผนงานร่วมกับ กองอำนวยความยุติธรรม ของศูนย์องค์การบริหารสามจังหวัดชายแดนภาคใต้ (ศอ.บต.) ซึ่งประกอบด้วยแผนงาน ดังนี้</p>
							<h5>เรื่องที่ 4	 องค์กรและกลไกการคุ้มครองสิทธิและเสรีภาพ</h5>
								<ol type=”1″>
									<li>
										<p class="text-justify">แผ่นการสนับสนุนงานทางด้านเอกสาร การจัดเตรียมเอกสารความรู้กฎหมายเบื้องต้นที่จำเป็น รวมทั้งในรูปสื่อต่างๆ โดยเฉพาะเรื่องที่เกี่ยวข้องกับการอำนวยความยุติธรรมในระดับชุมชน เช่น หนังสือคู่มือสิทธิและเสรีภาพ</p>
									</li>		
									<li>
										<p class="text-justify">การสนับสนุนงานทางด้านเครื่องอำนวยความสะดวกในด้านต่างๆ ได้แก่</p>
										<ul>  <!-- ข้อย่อย -->
										<li>
											<p class="text-justify">แผนการพัฒนาความรู้ให้ความรู้ทางกฎหมาย แก่เครือข่ายยุติธรรมตาดีกาสัมพันธ์อย่างสม่ำเสมอ ทั้งด้านกฎหมายพื้นฐานทั่วไป และกฎหมายพิเศษเฉพาะเรื่อง ทั้งในและนอกสถานที่ </p>
										</li>		
										<li>
											<p class="text-justify">สนับสนุนอุปกรณ์การสื่อสารที่จำเป็น เช่น บอร์ดติดประกาศในชุมชน คลื่นวิทยุชุมชน</p>
										</li>	
									</ul> <!-- ข้อย่อย -->
									</li>
									<li><p class="text-justify">แผนการพัฒนาความรู้ให้ความรู้ทางกฎหมาย แก่เครือข่ายยุติธรรมตาดีกาสัมพันธ์อย่างสม่ำเสมอ ทั้งด้านกฎหมายพื้นฐานทั่วไป และกฎหมายพิเศษเฉพาะเรื่อง ทั้งในและนอกสถานที่ </p></li>		
									<li><p class="text-justify">แผนการพัฒนาความรู้ให้ความรู้แก่ชาวบ้านเรื่องกฎหมายและสิทธิต่างๆโดยตรงเป็นครั้งคราว ทั้งในระดับหมู่บ้าน ตำบล อำเภอ จังหวัด</p></li>
									<li><p class="text-justify">แผนการจัดบุคลากรของกระทรวงยุติธรรมไว้ให้คำปรึกษา แก่สมาชิกเครือข่ายยุติธรรมตาดีกาสัมพันธ์ยามจำเป็น เพื่อทำหน้าที่ประสานเชื่อมโยง(Cooperation Linkage) ให้การปฏิบัติหน้าที่ของเครือข่ายยุติธรรมตาดีกาสัมพันธ์อย่างมีประสิทธิภาพ และไม่ถูกทอดทิ้งให้โดดเดี่ยว โดยอาจจัดให้มีโทรศัพท์สายตรง  (Hotline) ถึงผู้ประสานงาน หรือจัดให้มีหน่วยช่วยเหลือตอบประเด็นปัญหาในเบื้องต้น (Call Center) ทั้งในปัญหาเฉพาะราย หรือในเรื่องที่ชุมชนประสงค์จะวางกฎเกณฑ์ชุมชนในบางเรื่อง โดยเจ้าหน้าที่ของกรมฯอาจจะช่วยตรวจสอบถึงความเป็นไปได้เพื่อไม่ให้ขัดแย้งกับระบบกฎหมายที่มีอยู่ เว้นแต่กฎหมายที่มีอยู่ขัดต่อวิถีและขนบธรรมเนียมเดิมของชุมชน ก็อาจจะช่วยให้คำแนะนำชุมชนในการเสนอให้มีการแก้ไขกฎหมายให้เหมาะสมต่อไป</p></li>		
									<li><p class="text-justify">แผนการส่งตัวแทนไปร่วมรับฟังหรือส่งผู้เชี่ยวชาญหรือประสานงานเจ้าหน้าที่ที่เกี่ยวข้องหรือบุคคลอื่นที่เกี่ยวข้องกับปัญหาไปร่วมรับฟังแก้ไขปัญหากับชุมชน ในกระบวนการประชาพินิจหากเครือข่ายยุติธรรมตาดีกาสัมพันธ์ร้องขอ</p></li>
									<li><p class="text-justify">แผนการอำนวยความยุติธรรม กรณีที่ชาวบ้านถูกละเมิดสิทธิเสรีภาพจากหน่วยงานของรัฐ กระทรวงยุติธรรม ต้องให้การสนับสนุนให้คำแนะนำในระดับที่ชุมชนสามารถช่วยเหลือตนเองได้อย่างแท้จริง เช่น การขอข้อมูลจากคณะกรรมการข้อมูลข่าวสารฯ หรือ โดยการฟ้องคดีต่อศาลปกครองหรือการฟ้องเรียกค่าเสียหายคืน เป็นต้น</p></li>
								</ol>
						</div>
					  </div>
					
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
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto
						culpa amet.</p>
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
	
				<div class="col-md-4 col-md-push-1">
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

