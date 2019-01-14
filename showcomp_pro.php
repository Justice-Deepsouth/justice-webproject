<?php
    session_start();
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'php/dbconnect.php';
    include_once 'php/complaint_progress.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $complaint_progress = new Complaint_progress($db);
    $complaint_progress->complaint_progress_id = $_POST['pro_id'];
    $result = $complaint_progress->readone();
    $row = mysqli_fetch_array($result);
    $cdate = new DateTime();
    
?>

<div class="table-responsive">
    <input type="hidden" name="complaint-progress-id" value="<?php echo $row['complaint_progress_id'] ?>">
    <div class="row">
        <div class="col-md-offset-7"></div> 
        <div class="col-md-12">
            <div class="form-group">
                <textarea name="complaint-progress-desc" class="form-control" id="" cols="30" rows="7" placeholder="รายละเอียดการดำเนินการ" data-validation="required" data-validation-error-msg="บันทึกรายละเอียดการดำเนินการ"><?php echo $row['complaint_progress_desc'] ?></textarea>  
            </div>
            <label>วันที่ดำเนินการแก้ไข: <?php echo date_format($cdate,'d/m/Y'); ?></label>
        </div> 
    </div>
</div>