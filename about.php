<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Justice Deep South Project by Justice League Team</title>
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
				   					<h1>เกี่ยวกับโครงการ</h1>
										<h2>ใส่ Quote เกี่ยวกับความยุติธรรม</h2>
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
					<p>กระทรวงยุติธรรมร่วมกับคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี จัดทำโครงการวิจัยเชิงปฏิบัติการสร้างความเป็นธรรมโดยกระบวนการยุติธรรม กรณีโรงเรียนเอกสารสอนศาสนาอิสลามในจังหวัดชายแดนภาคใต้ เพื่อขับเคลื่อนงานด้านกระบวนการยุติธรรมในจังหวัดชายแดนภาคใต้ โดยใช้รากฐานทางวัฒนธรรมเป็นปัจจัยสำคัญในการขับเคลื่อน และดำเนินงานตามแนวทางความเสมอภาคทางโอกาส การมีส่วนร่วม และสิทธิมนุษยชน โดยเน้นการทำงานที่ 1) สร้างความเข้าใจ การเห็นคุณค่า และการปฏิบัติงานด้านความหลากหลายของผู้คน เพื่อให้เกิดความยุติธรรมและการมีส่วนร่วมอย่างเต็มที่ในการสร้างความเป็นธรรมในพื้นที่ชายแดนใต้, 2) การส่งเสริมความเสมอภาคทางโอกาส รวมถึงการทำแบบประเมินผลกระทบ และการคัดกรองความเสมอภาคเชิงนโยบาย การทำงาน และแผนการดำเนินงานด้านความหลากหลาย, 3) เน้นการทำงานและปฏิบัติกับผู้ร่วมงานอย่างเท่าเทียม ให้เกียรติ และความเคารพ เพื่อกระตุ้นให้นักรียน และครูอาจารย์เกิดความเข้าใจและนำไปใช้ได้จริงในชีวิตประจำวัน, และ 4) เน้นการสร้างแนวคิดเพื่อขจัดการเลือกปฏิบัติ และอุปสรรค พร้อมทั้งสร้างความสมดุล ความเสมอภาคในสังคมชายแดนใต้</p>
					<p>นอกจากนั้นโครงการฯ นี้ ยังมีเป้าหมายสำคัญ คือ การเกิดศูนย์ยุติธรรมชุมชนในโรงเรียนเอกชนสอนศาสนาอิสลาม ที่ก่อตั้ง โดยผู้บริหาร ครู และนักเรียนในโรงเรียนเอกชนสอนศาสนาอิสลาม บริหารงานโดยบุคลากรในโรงเรียนเอกชนสอนศาสนาอิสลาม และคนในชุมชน ทำงานเพื่อคนในชุมชน โดยมีหน่วยงานของกระทรวงยุติธรรมเป็นฝ่ายสนับสนุน การดำเนินงานตามโครงการฯ ได้ยึดเป้าหมายและภารกิจต่างๆ ที่กล่าวมาข้างต้นนี้ ซึ่งสามารถแจกแจงกระบวนการดำเนินงานที่ผ่านมาได้ดังนี้</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<div class="about-desc">						
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#step1">ขั้นตอนที่ 1 การเผยแนวคิดยุติธรรมสู่ประชาชน</button>
						<div id="step1" class="collapse">ภายใต้กระบวนการศึกษา จะยึดแนวทางการมีส่วนร่วมและการบูรณาการภายใต้บริบทของชุมชนเป็นหลัก ซึ่งพบว่าวิธีการส่งเสริมหรือเผยแพร่ความรู้ และกิจกรรมต่างๆ ที่เกี่ยวข้องกับงานยุติธรรม การทำงานของโครงการได้เน้นการเผยแพร่แนวคิดการทำงานทางด้านยุติธรรมชุมชน และการสร้างเครือข่ายยุติธรรมโรงเรียนเอกชนสอนศาสนาอิสลาม และชุมชนสู่กลุ่มต่างๆในพื้น สามารถจำแนกออกเป็น 4 ระดับ คือ <br><br>
						<h5>1.เครือข่ายโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด</h5>
						<p>ในพื้นที่ทั้งสามจังหวัด จะมีกลุ่มกรรมการโรงเรียนเอกชนสอนศาสนาอิสลาม ในแต่ละจังหวัด โดยในคณะกรรมการนั้นจะมาจากผู้นำศาสนาในแต่ละอำเภอภายในจังหวัดนั้นๆ ประกอบกับกรรมการที่มีความรู้ความเชียวชาญในแต่ละด้าน ซึ่งส่วนใหญ่จะเป็นผู้ที่คนในพื้นที่ให้การยอมรับ ดังนั้นการเผยแพร่ ส่งเสริม ความรู้ทางด้านกระบวนการยุติธรรมผ่านกลุ่มคนเหล่านี้ จึงมีความจำเป็นอย่างมาก เนื่องจากบุคคลเหล่านี้มีความพร้อมที่จะเรียนรู้ และมีความสามารถที่จะเผยแพร่ความรู้สู่ชุมชนภายในพื้นที่ การสร้างความตระหนักและการพัฒนาศักยภาพของคณะกรรมการเครือข่ายยุติธรรมตาดีกาสัมพันธ์ในแต่ละจังหวัดจึงมีความสำคัญอย่างมาก</p>
						<h5>2.กรรมการในสมาคมครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด</h5>
						<p>ในแต่ละจังหวัดจะมีสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.) อยู่ และมีสมาคมโรงเรียนเอกชาสอนศาสนาอิสลาม ซึ่งสมาชิกในสมาคมมาจากผู้บริหาร และคณะครูสอนโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด โดยส่วนใหญ่จำนวนสมาชิกของสมาคมจะขึ้นอยู่กับจำนวนโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัด การติดต่อหรือการประสานงานภายในจังหวัดถ้าผ่านทางสมาคมจะทำให้การประสานสำเร็จได้ด้วยดี ดังนั้นในการเผยแพร่ความรู้ความเข้าใจทางด้านงานยุติธรรม ถ้าผ่านทางเครือข่ายสมาคมครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละอำเภอ และให้สมาชิกเผยแพร่สู่ประชาชนในหมู่บ้านต่างๆ ภายในตำบลของตน การส่งเสริมการคุ้มครองสิทธิและเสรีภาพก็อาจจะสำเร็จอีกในระดับหนึ่ง</p>
						<h5>3.การเผยแพร่สู่ครูโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละโรงเรียน</h5>
						<p>การติดต่อ หรือการเชิญผู้บริหาร และครูโรงเรียนเอกชนสอนศาสนาอิสลาม ในแต่ละโรงเรียนจะประสานผ่านสมาชิกสมาคมโรงเรียนเอกชนสอนศาสนาอิสลาม และสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.)  เนื่องจากสมาชิกแต่ละคนจะมีความคุ้นเคยกับโรงเรียนในพื้นที่สามารถประสานงานได้ง่าย และสะดวกกว่า การเผยแพร่ในระดับนี้จะเป็นการสร้างความรู้ความเข้าใจให้กับผู้บริหาร และครูในโรงเรียนเอกชนสอนศาสนาอิสลามในแต่ละจังหวัดเพื่อให้เกิดความตระหนักและเห็นถึงความสำคัญของสิทธิและเสรีภาพ อันจะนำไปสู่การเผยแพร่สู่คนในหมู่บ้านต่อไป</p>
						<h5>4.การเผยแพร่ในโรงเรียนเอกชนสอนศาสนาอิสลาม</h5>
						<p>การเผยแพร่ความรู้ ความเข้าใจในด้านสิทธิและเสรีภาพสู่กลุ่ม เด็กและเยาวชนที่ศึกษาอยู่ในโรงเรียนเอกชนสอนศาสนาอิสลาม มีความสำคัญเป็นอย่างมาก การจัดทำหลักสูตรในโครงการนี้จะนำร่องเผยแพร่ ในโรงเรียนเอกชนสอนศาสนาอิสลามที่กรรมการสมาคมโรงเรียนเอกชนสอนศาสนาอิสลาม และสำนักงานโรงเรียนเอกชนสอนศาสนาอิสลามประจำจังหวัด (สช.) ในแต่ละจังหวัด เป็นเจ้าของหรือสอนอยู่ก่อนเป็นอันดับแรก โดยจะให้ความรู้ในกลุ่มครูก่อน จากนั้นจะเผยแพร่สู่กลุ่มนักเรียน และผู้ปกครอง</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<div class="about-desc">
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#step2">ขั้นตอนที่ 2 การสำรวจปัญหาและความต้องการความเป็นธรรม<br>ในกระบวนการยุติธรรมของนักเรียน และบุคลากรโรงเรียนเอกชน<br>สอนศาสนาอิสลามในจังหวัดชายแดนใต้</button>
						<div id="step2" class="collapse"><p>การวิเคราะห์และประมวลผลจากแบบสำรวจปัญหาและความต้องการความเป็นธรรมในกระบวนการยุติธรรมของผู้บริหาร ครูเกี่ยวกับบทบาททางสังคมในชุมชนพบว่า ผู้บริหาร ครูส่วนใหญ่ ไม่มีบทบาททางสังคมหรือในชุมชน  จำนวน 98 คน คิดเป็นร้อยละ 68.5 ของกลุ่มประชากรทั้งหมด ซึ่งถือเป็นสัดส่วนที่มีจำนวนมากที่สุดในขณะที่สิ่งที่ต้องการพัฒนา พบว่าผู้บริหาร ครูส่วนใหญ่สนใจและต้องการพัฒนาด้านภาษาจำนวน 97 คน คิดเป็นร้อยละ 45.12 ซึ่งถือเป็นสัดส่วนที่มากที่สุด ในขณะที่เป็นที่น่าสังเกตว่าความต้องการพัฒนาทักษะการเจรจาไกล่เกลี่ยนั้นน้อยที่สุด จำนวน 47 คน คิดเป็นร้อยละ 21.86 ซึ่งควรมีการศึกษาในเชิงรายละเอียดเพิ่มเติมเกี่ยวกับสาเหตุในความต้องการในเรื่องทักษะดังกล่าวว่าเหตุใดจึงน้อยที่สุด และควรมีการหาแนวทางในการเพิ่มเติมข้อมูล องค์ความรู้เกี่ยวกับกระบวนการยุติธรรม สิทธิมนุษยชน โดยเฉพาะการออกแบบเชิงกระบวนการเพื่อสร้างการเข้าถึงข้อมูลความรู้ดังกล่าว</p></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<div class="about-desc">
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#step3">ขั้นตอนที่ 3 การจัดทำหลักสูตรการพัฒนาความรู้</button>
						<div id="step3" class="collapse"><p>ในขั้นตอนนี้คณะผู้ดำเนินการจึงได้มีการศึกษาแนวคิด ทฤษฎี และงานวรรณกรรมที่เกี่ยวข้อง และได้นำผลการศึกษา จากผลการวิเคราะห์ สังเคราะห์เกี่ยวกับการสร้างความเป็นธรรมด้วยกระบวนการยุติธรรมให้เกิดขึ้นในโรงเรียนเอกชนสอนศาสนาอิสลามในพื้นที่สามจังหวัดชายแดนภาคใต้ให้เกิดขึ้นอย่างเป็นรูปธรรมภายใต้ความร่วมมือและการมีส่วนร่วมของทุกฝ่าย และควรจัดอบรมเสริมสร้างความเข้าใจในเรื่องนี้ในองค์ความรู้ทางด้านสิทธิเสรีภาพ และความยุติธรรมให้เกิดความสมบูรณ์จึงนำมาสู่การร่างหลักสูตร “การสร้างสันติด้วยความเป็นธรรมภายใต้กระบวนการยุติธรรมในจังหวัดชายแดนภาคใต้”</p></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<div class="about-desc">
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#step4">ขั้นตอนที่ 4 การส่งเสริมและพัฒนาเครือข่ายโรงเรียนเอกชนสอนศาสนาอิสลาม</button>
							<div id="step4" class="collapse"><p></p></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<div class="about-desc">
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#step5">ขั้นตอนที่ 5 ระบบการคุ้มครองและเยียวยางานทางด้านกระบวนการยุติธรรม</button>
						<div id="step5" class="collapse"><p></p></div>
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

