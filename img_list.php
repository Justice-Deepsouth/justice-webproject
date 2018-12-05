<?php
session_start();
	
    // set current timezone
date_default_timezone_set("Asia/Bangkok");

    /* if (!isset($_SESSION['user_session_id']) && !isset($_SESSION['user_state'])) {
		if ($_SESSION['user_state'] != 0) {
			header("Location: ../index.php");
		}
	} */
include_once 'php/dbconnect.php';
include_once 'php/complaint_photo.php';

// get connection
$database = new Database();
$db = $database->getConnection();

// pass connection to property_types table
$complaint_photos = new Complaint_photo($db);

	// read all records

$complaint_photos->complaint_id = $_GET['comp_id'];
$active = true;
$result = $complaint_photos->readall($active);
$total_rows = $complaint_photos->getTotalRows();
$row = mysqli_fetch_array($result);

$cid = $complaint_photos->complaint_id;



$output = '';

//delete
if (isset($_GET['complaint_photo_id'])) {
	$complaint_photos->complaint_photo_id =$_GET['complaint_photo_id'];
	$img = $complaint_photos->readone();
	$data = mysqli_fetch_array($img);

	$file_path = 'comp_img/'.$data['complaint_photo_name'];
	if (unlink($file_path)) {
		if ($complaint_photos->delete()) {
			header("Location: img_list.php?comp_id=".$data['complaint_id']);
		}
	}
}


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
	
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
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
						<div id="fh5co-logo"><a href="index.php">ชื่อโครงการ</a></div>
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
							<li><a href="complaint_login.php">ร้องเรียน</a></li>
							<li><a href="about.php">เกี่ยวกับโครงการ</a></li>
							<li><a href="contact.php">ติดต่อ</a></li>
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
				<div class="col-md-3 col-sm-2">
					<section id="sidebar">
						<header>
							<h3>ประเภทข้อมูล</h3>
						</header>
						<aside>
							<ul class="sidebar-navigation">
								<!-- <li><a href="admin_main.php"><i class="icon-settings"></i><span> ข้อมูลการติดต่อ</span></a></li>
								<li><a href="complaint_types_list.php"><i class="icon-settings"></i><span> ประเภทข้อร้องเรียน</span></a></li> -->
								<li class="active"><a href="complaint_status.php"><i class="icon-settings"></i><span> สถานะข้อร้องเรียน</span></a></li>
								<!-- <li><a href="users_list.php"><i class="icon-settings"></i><span> ข้อมูลผู้ใช้งาน</span></a></li> -->
							</ul>
						</aside>
					</section><!-- /#sidebar -->
				</div><!-- /.col-md-3 -->
				<!-- end Sidebar -->
				<div class="col-md-7 col-md-push-1 animate-box">
					<div class="row">
							<input type="hidden" name="complaint-id" value="<?php echo $row['complaint_id']; ?>">
							<div class="form-group">
								<button data-toggle="modal" data-target="#add-modal" data-id="<?php echo $row['complaint_id']; ?>" id="getComplaint_id" class="btn btn-sm btn-info" >เพิ่มรูปภาพ</button>
							</div>
					<div class="col-md-12">
                    <div class="table-responsive">
                            <table class="table">
                            <thead>
                             <tr>
                                 <th>ลำดับ</th>
                                 <th>รูป</th>
                                 <th class="text-center">แก้ไขข้อมูล</th>
                                 <th class="text-center">ลบข้อมูล</th>
                            </tr>
                            </thead>
                            <?php 
									if ($total_rows > 0) {
									$count = 0;
									foreach ($result as $row) {
									$count++;
									
                                    // $output .= ' ';
								?>
                              <tr>
                               <td><?php echo $count ?></td>
                               <td><img src="comp_img/<?php echo $row["complaint_photo_name"]; ?>" name="complaint-photo-name" class="img-thumbnail" width="100" height="100" /></td>
							   <td class="text-center"><button data-toggle="modal" data-target="#edit-modal" data-id="<?php echo $row['complaint_photo_id']; ?>" id="getPhoto_id" class="btn btn-sm btn-warning"><i class="icon-pencil2"></i></button></td>

                               <td class="text-center">
                               <a href="#"  data-href="img_list.php?complaint_photo_id=<?php echo $row["complaint_photo_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger"><i class="icon-bin"></i></a>

                               </td>
							   

 
                               </tr>
                             
                               <?php 
								}
								} else {
								$output .= '
                              <tr>
                               <td colspan="6" align="center">ไม่พบข้อมูล</td>
                              </tr>
                             ';
							}
							$output .= '</table>';
							echo $output;
							?>

						</div>
					</div><!-- /.row -->
					</form>
				</div>
			</div>
		</div>
	</div><!-- END container-wrap -->

	<!-- Delete Dialog -->
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

    <div id = "edit-modal" class = "modal fade" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true" style = "display: none;">
         <div class = "modal-dialog"> 
            <div class = "modal-content">       
                <div class = "modal-header"> 
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">×</button> 
                    <h4 class = "modal-title">แก้ไขรูปภาพ</h4> 
                </div> 
                <div class = "modal-body">        
                    <div id = "modal-loader" style = "display: none; text-align: center;">
                       	<img src = "ajax-loader.gif">
                    </div>                            
                    <!-- content will be load here -->                          
                    <div id = "dynamic-content"></div>                             
                </div> 
                <!-- <div class = "modal-footer"> 
				
                </div>  -->
                        
            </div> 
        </div>
    </div><!-- /.modal -->

	    <div id = "add-modal" class = "modal fade" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true" style = "display: none;">
         <div class = "modal-dialog"> 
            <div class = "modal-content">       
                <div class = "modal-header"> 
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">×</button> 
                    <h4 class = "modal-title">เพิ่มรูปภาพ</h4> 
                </div> 
                <div class = "modal-body">        
                    <div id = "modal-loader" style = "display: none; text-align: center;">
                       	<img src = "ajax-loader.gif">
                    </div>                            
                    <!-- content will be load here -->                          
                    <div id = "dynamic1-content"></div>                             
                </div> 
                <!-- <div class = "modal-footer"> 
				
                </div>  -->
                        
            </div> 
        </div>
    </div><!-- /.modal -->

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
    <script type="text/javascript"></script>
  

	<script>
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('#confirm').attr('href', $(e.relatedTarget).data('href'));
		});

        $(document).ready(function(){	
	        $(document).on('click', '#getPhoto_id', function(e){
		        e.preventDefault();
		        var photo_id = $(this).data('id');   // it will get id of clicked row
		        $('#dynamic-content').html(''); // leave it blank before ajax call
		        $('#modal-loader').show();      // load ajax loader
		        $.ajax({
			        url: 'edit_img.php',
			        type: 'POST',
			        data: 'photo_id='+photo_id,
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

		 $(document).ready(function(){	
	        $(document).on('click', '#getComplaint_id', function(e){
		        e.preventDefault();
		        var complaint_id = $(this).data('id');   // it will get id of clicked row
		        $('#dynamic-content').html(''); // leave it blank before ajax call
		        $('#modal-loader').show();      // load ajax loader
		        $.ajax({
			        url: 'add_img.php',
			        type: 'POST',
			        data: 'complaint_id='+complaint_id,
			        dataType: 'html'
		        })
		        .done(function(data){
			        console.log(data);	
			        $('#dynamic1-content').html('');    
			        $('#dynamic1-content').html(data); // load response 
			        $('#modal-loader').hide();		  // hide ajax loader	
		        })
		        .fail(function(){
			        $('#dynamic1-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			        $('#modal-loader').hide();
		        });
	        });
        });
	</script>

	</body>
</html>
