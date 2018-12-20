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
	
	// etLast_Complaint_Photo_ID
	$complaint_photos->complaint_id = $_POST['complaint_id'];
	$mComplaint_ID = $complaint_photos->getLast_Complaint_Photo_ID();
	$Complaint_ID = $_POST['complaint_id'];
	// echo $mComplaint_ID;
	// exit(0);

?>

<form action="create_img.php" method="post" enctype="multipart/form-data">  
	<input type="hidden" name="complaint-id" value="<?php echo $Complaint_ID ?>">
	<input type="hidden" name="complaint-photo-id" value="<?php echo $mComplaint_ID ?>">
	<center><h4>รูปที่ต้องการเพิ่ม</h4></center>
	<div class="col-md-12">
		<div id="image_preview"></div>
	</div>
	<input type="file" id= "complaint_photo" name="complaint_photo[]" multiple >
	<br>
	<div class ="text-center">
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
		<input type="submit" value="บันทึก" class="btn btn-primary btn-modify" name="add_photo-submit"> 
	</div>
</form>
 
<script type="text/javascript">
  	$("#complaint_photo").change(function(){
    	$('#image_preview').html("");
     	var total_file=document.getElementById("complaint_photo").files.length;

     	for(var i=0;i<total_file;i++) {
      		$('#image_preview').append("<center><img src='"+URL.createObjectURL(event.target.files[i])+"' width='250' height='250'></center>");
     	}
  });
</script>