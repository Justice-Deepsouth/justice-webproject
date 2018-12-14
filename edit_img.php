<?php
	include_once 'php/dbconnect.php';
	include_once 'php/complaint_photo.php';
	include_once 'php/complaint.php';
	
	// get connection
	$database = new Database();
	$db = $database->getConnection();
	
	// pass connection to property_types table
	$complaint_photos = new Complaint_photo($db);
	$complaint = new Complaint($db);	
		
	// read one records
	$mComplaint_ID = $complaint->getComplaint_ID();
	$complaint_photos->complaint_photo_id = $_POST['photo_id'];
	$result = $complaint_photos->readone();
	$row = mysqli_fetch_array($result);
?>

<!-- <form action="update_img.php" method="post" enctype="multipart/form-data"> -->
    <input type="hidden" name="complaint-photo-id" value="<?php echo $row['complaint_photo_id']; ?>">
	<input type="hidden" name="complaint-id" value="<?php echo $row['complaint_id']; ?>">
	<center><h4>รูปปัจจุบัน</h4></center>
    <div class ="text-center">
		<img src="comp_img/<?php echo $row["complaint_photo_name"]; ?>" name="complaint-photo-name" width="250" height="250" />
	</div>
    <br>
	<center><h4>รูปที่ต้องการแก้ไข</h4></center>
	<div class="col-md-12">
		<div id="image_preview"></div>
	</div>
	<input type="file" id= "complaint_photo" name="complaint_photo" multiple >
	<br>
	<!-- <div class ="text-center">
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
		<input type="submit" value="บันทึก" class="btn btn-primary btn-modify" name="edit_photo-submit"> 
	</div> -->
<!-- </form> -->
 
<script type="text/javascript">
	$("#complaint_photo").change(function(){
    	$('#image_preview').html("");
    	var total_file=document.getElementById("complaint_photo").files.length;

    	for(var i=0;i<total_file;i++) {
			$('#image_preview').append("<center><img src='"+URL.createObjectURL(event.target.files[i])+"' width='250' height='250'></center>");
    	}
  	});
</script>