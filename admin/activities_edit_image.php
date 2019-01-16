<?php
	session_start();
	ob_start();
    /* if (!isset($_SESSION['user_session_id'])) {
        header("Location: ../index.php");
	} */
	
    // set current timezone
	date_default_timezone_set("Asia/Bangkok");

	include_once '../php/dbconnect.php';
	include_once '../php/activity.php';

    // get connection
	$database = new Database();
	$db = $database->getConnection();

    // pass connection to property_states table
	$activity = new Activity($db);
	$activity->activity_id = $_POST['activity_id'];
	$result = $activity->readone();
	$row = mysqli_fetch_array($result);
	ob_end_flush();
?>

<!-- <form action="update_img.php" method="post" enctype="multipart/form-data"> -->

<input type="hidden" name="activity-id" value="<?php echo $row['activity_id']; ?>">
<div class ="text-center">
	<?php
		if ($row['activity_image'] !="") {
			echo "<div class ='text-center'><h4>รูปปัจจุบัน</h4>";
			echo "<img src='../activity_img/$row[activity_image]' name='activity-oldImage' width='250' height='250' />";
		} else{}		
	?>
	<br> <br>
	<h4>รูปที่ต้องการแก้ไข</h4>
	<div class="col-md-12">
		<div id="image_preview"></div>
	</div>
	<input type="file" id= "activity-image" name="activity-image" >
	<br>
</div>
 
<script type="text/javascript">
	$("#activity-image").change(function(){
    	$('#image_preview').html("");
    	var total_file=document.getElementById("activity-image").files.length;

    	for(var i=0;i<total_file;i++) {
			$('#image_preview').append("<center><img src='"+URL.createObjectURL(event.target.files[i])+"' width='250' height='250'></center>");
    	}
  	});
</script>