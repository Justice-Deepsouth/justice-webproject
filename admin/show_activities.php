<?php
    session_start();

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
?>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
		<tr>
			<th>กิจกรรม</th>
			<td><?php echo $row['activity_name']; ?></td>
		</tr>
		<tr>
			<th>รายละเอียดกิจกรรม</th>
			<td><?php echo wordwrap($row['activity_desc'], 60, "\n", true); ?></td>
		</tr>
        <tr>
			<th>สถานที่จัดกิจกรรม</th>
			<td><?php echo $row['activity_place']; ?></td>
		</tr>
        <tr>
            <th>วันเริ่มกิจกรรม</th>
            <td>
                <?php 
                    $strDate = $row['activity_sdate'];
                    $newDate = date("d-M-Y", strtotime($strDate));
                    $strYear = date("Y", strtotime($strDate)) + 543;
                    $strMonth = date("n", strtotime($strDate));
                    $strDay = date("j", strtotime($strDate));
                    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                    $strMonthThai = $strMonthCut[$strMonth];
                    $strDate = "$strDay $strMonthThai $strYear";
                    echo $strDate;
                ?>
            </td>
        </tr>
        <tr>
             <th>วันสิ้นสุดกิจกรรม</th>
             <td>
                 <?php 
                    $strDate = $row['activity_edate'];
                    $newDate = date("d-M-Y", strtotime($strDate));
                    $strYear = date("Y", strtotime($strDate)) + 543;
                    $strMonth = date("n", strtotime($strDate));
                    $strDay = date("j", strtotime($strDate));
                    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                    $strMonthThai = $strMonthCut[$strMonth];
                    $strDate = "$strDay $strMonthThai $strYear";
                    echo $strDate;
                ?>
            </td>
        </tr>
        <tr>
			<th>รูปภาพกิจกรรม</th>
            <td>
                <img src='../activity_img/<?php echo $row['activity_image'] ?>' name='activity-image' class='img-thumbnail' width='250' height='250' />
            </td>
		</tr>
	</table>
</div> 