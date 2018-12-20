<?php
include_once 'php/dbconnect.php';
include_once 'php/complaint_video.php';
include_once 'php/complaint.php';
    // get connection
$database = new Database();
$db = $database->getConnection();
    // pass connection to property_types table
$complaint_videos = new Complaint_video($db);
$complaint = new Complaint($db);
	
	
	// etLast_Complaint_video_ID
$complaint_videos->complaint_id = $_POST['complaint_id'];
$mComplaint_ID = $complaint_videos->getLast_Complaint_video_ID();
$Complaint_ID = $_POST['complaint_id'];
// echo $mComplaint_ID;
// exit(0);

?>


<form action="create_video.php" method="post" enctype="multipart/form-data">  
	<input type="hidden" name="complaint-id" value="<?php echo $Complaint_ID ?>">
<input type="hidden" name="complaint-video-id" value="<?php echo $mComplaint_ID ?>">

	<!-- <center><h4>วีดีโอที่ต้องการเพิ่ม</h4></center> -->
	<div class="col-md-12">
	<div id="video_preview"></div>
	</div>

					<input type="file" id= "complaint_video" name="complaint_video[]" multiple >
					<br>
					<div class ="text-center">
					<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
					<input type="submit" value="บันทึก" class="btn btn-primary btn-modify" name="add_video-submit"> 
					</div>

					</form>
 
<!-- <script type="text/javascript">
  

  $("#complaint_video").change(function(){
     $('#video_preview').html("");
     var total_file=document.getElementById("complaint_video").files.length;


     for(var i=0;i<total_file;i++)
     {
      $('#video_preview').append("<center><video width="320" height="240" controls><source src='"+URL.createObjectURL(event.target.files[i])+"' name='complaint-video-name' type="video/mp4">'"Your browser does not support the video tag."'</video></center>");
     }


  });

</script> -->