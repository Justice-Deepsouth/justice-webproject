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


<form action="create_video.php" id="complaint" method="post" enctype="multipart/form-data">  
	<input type="hidden" name="complaint-id" value="<?php echo $Complaint_ID ?>">
<input type="hidden" name="complaint-video-id" value="<?php echo $mComplaint_ID ?>">

	<!-- <center><h4>วีดีโอที่ต้องการเพิ่ม</h4></center> -->
	<div class="col-md-12">
	<div id="video_preview"></div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<div class="progress progress-striped active">
				<div class="progress-bar" style="width:0%"><p id="msg">0%</p></div>
			</div>
		</div>
	</div>
					<input type="file" id= "complaint_video" name="complaint_video[]" multiple >
					<br>
					<div class ="text-center">
					<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
					<input type="submit" value="บันทึก" class="btn btn-primary btn-modify" name="add_video-submit"> 
					</div>

					</form>



	<!-- progress bar -->
	<script>$(function(){
    $('#complaint').ajaxForm({
        beforeSend:function(){
            $('.progress').show();
        },
        uploadProgress:function(event,position,total,percentcomplete){
			$('.progress-bar').width(percentcomplete+"%");
			$('#msg').html(percentcomplete+"%")
			if(percentcomplete==100){
				alert("อัพโหลดไฟล์เสร็จสิ้น");
			}
		},
        success:function(){
			$('.progress').hide();
		},
        complete:function(){
			window.location.href = "video_list.php?comp_id=<?php echo $Complaint_ID; ?>";
		}
		});
		$('.progress').hide();
	});
	</script>
    <!-- progress bar -->