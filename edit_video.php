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
		
	// read one records
	$mComplaint_ID = $complaint->getComplaint_ID();
	$complaint_videos->complaint_video_id = $_POST['video_id'];
	$result = $complaint_videos->readone();
	$row = mysqli_fetch_array($result);
?>

<!-- <form action="update_video.php" method="post" enctype="multipart/form-data"> -->
<input type="hidden" name="complaint-video-id" value="<?php echo $row['complaint_video_id']; ?>">
<input type="hidden" name="complaint-id" value="<?php echo $row['complaint_id']; ?>">
<div class ="text-center"> 
	<h4>วีดีโอปัจจุบัน</h4>
        <video width="400" controls>
            <source src="comp_video/<?php echo $row['complaint_video_name'] ?>" name='complaint-video-name' type="video/mp4">
            Your browser does not support the video tag.
        </video>	
    <br>
	<h4>วีดีโอใหม่</h4>
    <video width="400" controls>
        <source src="" id="video_here">
    </video>

    <input type="file" class="file_multi_video" name="complaint_video" >
	<br>

</div>

	<!-- progress bar -->
	<script>$(function(){
    $('#upvideo').ajaxForm({
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on("change", ".file_multi_video", function(evt) {
  		var $source = $('#video_here');
  		$source[0].src = URL.createObjectURL(this.files[0]);
  		$source.parent()[0].load();
	});
</script>
