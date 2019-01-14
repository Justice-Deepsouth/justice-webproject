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
    include_once '../php/article.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $article = new Article($db);

	// read all records
	$active = false;
    $result = $article->readall($active);
    $total_rows = $article->getTotalRows();

    if (isset($_GET['type_id'])) {
        $article->article_id = $_GET['type_id'];
        if ($article->delete()) {
            header("Location: articles_list.php");
        }
	}
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
								<li><a href="users_list.php"><i class="icon-settings"></i><span> ข้อมูลผู้ใช้งาน</span></a></li>
								<li><a href="settings_update.php"><i class="icon-settings"></i><span> ข้อมูลการตั้งค่า</span></a></li>
								<li><a href="activities_list.php"><i class="icon-settings"></i><span> ข้อมูลกิจกรรม</span></a></li>
								<li class="active"><a href="#"><i class="icon-settings"></i><span> ข้อมูลบทความ</span></a></li>
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="button" value="เพิ่มข้อมูล" class="btn btn-outline" onclick="location.href='article_add.php';">
							</div>
						</div>
					</div><!-- /.row -->
					<div class="row">
						<div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ชื่อบทความ</th>
                                    <th>สถานะ</th>
                                    <th class="text-center">แก้ไขข้อมูล</th>
                                    <th class="text-center">ลบข้อมูล</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>
										<a href="" data-toggle="modal" data-target="#showdata" data-id="<?php echo $row['article_id']; ?>" id="getarticle_id"><?php echo $row['article_title'];?></a>
										</td>
                                        <td><?php if ($row['article_status']) {
                                            echo "ใช้งานปกติ";
                                        } else { echo "ยกเลิกการใช้งาน"; } ?></td>
                                        <td class="text-center">
                                            <a href="article_update.php?art_id=<?php echo $row['article_id']; ?>" class="edit"><i class="icon-pencil2"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="delete" data-href="articles_list.php?type_id=<?php echo $row['article_id']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="icon-bin"></i></a>
                                        </td>
                                    </tr>
								<?php } ?>
                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->
					</div><!-- /.row -->
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

	<!-- Modal Dialog -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ยืนยันการลบข้อมูล</h4>
				</div>
				<div class="modal-body">
				<p>แน่ใจว่าต้องการลบข้อมูลนี้?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
					<a class="btn btn-danger" id="confirm">ลบข้อมูล</a>
				</div>
			</div>
		</div>
	</div>

	<div id = "showdata" class = "modal fade" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true" style = "display: none;">
        <div class = "modal-dialog"> 
            <div class = "modal-content">       
                <div class = "modal-header"> 
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">×</button> 
                    <h4 class = "modal-title">รายละเอียดบทความ</h4> 
                </div> 
                <div class = "modal-body">        
                    <div id = "modal-loader" style = "display: none; text-align: center;">
                       	<img src = "ajax-loader.gif">
                    </div>                            
                    <!-- content will be load here -->                          
                    <div id = "dynamic-content"></div>                             
                </div> 
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
				</div>
                        
            </div> 
        </div>
    </div><!-- /.modal -->

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
	<script>
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('#confirm').attr('href', $(e.relatedTarget).data('href'));
		});
	</script>

	<script>
        $(document).ready(function(){	
	        $(document).on('click', '#getarticle_id', function(e){
		        e.preventDefault();
		        var article_id = $(this).data('id');   // it will get id of clicked row
		        $('#dynamic-content').html(''); // leave it blank before ajax call
		        $('#modal-loader').show();      // load ajax loader
		        $.ajax({
			        url: 'showarticle_desc.php',
			        type: 'POST',
			        data: 'article_id='+article_id,
			        dataType: 'html'
		        })
		        .done(function(data){
			        console.log(data);	
			        $('#dynamic-content').html('');    
			        $('#dynamic-content').html(data); // load response 
			        $('#modal-loader').hide();		  // hide ajax loader	
		        })
		        .fail(function(){
			        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			        $('#modal-loader').hide();
		        });
	        });
        });
	</script>
	</body>
</html>
