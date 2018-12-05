<?php
    session_start();

    /* if (!isset($_SESSION['user_session_id'])) {
        header("Location: ../index.php");
	} */
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'php/dbconnect.php';
    include_once 'php/complaint.php';
    include_once 'php/complaint_progress.php';
    include_once 'php/complaint_photo.php';
    include_once 'php/complaint_state.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_states table
	$complaint = new Complaint($db);
    $complaint->complaint_id = $_POST['comp_id'];

    $complaint_progress = new Complaint_progress($db);
    $complaint_progress->complaint_id = $_POST['comp_id'];


    $complaint_photos = new Complaint_photo($db);
    $complaint_photos->complaint_id = $_POST['comp_id'];
    $active = true;
    $img = $complaint_photos->readall($active);

    $result = $complaint_progress->readall();
    
    $resultcomp = $complaint->readone();
    $rowcomp = mysqli_fetch_array($resultcomp);

    $complaint_state = new Complaint_state($db);

?>
<div class="table-responsive">
<table class="table table-striped table-bordered">
		<tr>
			<th>เรื่อง</th>
			<td><?php echo $rowcomp['complaint_title']; ?></td>
		</tr>
		<tr>
			<th>รายละเอียด</th>
			<td><?php echo wordwrap($rowcomp['complaint_desc'], 60, "\n", true); ?></td>
		</tr>
        <tr>
			<th>รูปภาพ</th>
            <td>
            <?php while ($data = mysqli_fetch_array($img)) { ?>

            <img src='comp_img/<?php echo $data['complaint_photo_name'] ?>' name='complaint-photo-name' class='img-thumbnail' width='250' height='250' />

            <?php } ?>
            </td>
		</tr>
	</table>
    <table class="table table-striped table-bordered">
		<tr>
			<th>ประวัติการดำเนินการ</th>
            <td> <?php while ($row = mysqli_fetch_array($result)) {
            $complaint_state->complaint_state_id = $row['complaint_state_id'];
            $resultstate = $complaint_state->readone();
            $rowstate = mysqli_fetch_array($resultstate);
                    echo "<b>สถานะ : ".$rowstate['complaint_state_desc']."</b><br>";
                    echo "รายละเอียดการดำเนินการ : ".$row['complaint_progress_desc']."<br><br>";

            } ?>
            </td>
		</tr>
	</table>
</div> 