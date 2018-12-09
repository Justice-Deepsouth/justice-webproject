<?php
    session_start();

    /* if (!isset($_SESSION['user_session_id'])) {
        header("Location: ../index.php");
	} */
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once 'php/dbconnect.php';
	include_once 'php/complaint_state.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $complaint_state = new Complaint_state($db);
?>

<div class="table-responsive">
    <form role="form" id="complaint-states" method="post" action="complaint_status.php">
    <input type="hidden" name="complaint-id" value="<?php echo $_POST['comp_id'] ?>">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            การดำเนินการ
                <select class="form-control" name="complaint-state-id">
                    <?php
                    $resultafo = $complaint_state->readallforone();
                    while ($rowafo = mysqli_fetch_array($resultafo)) { ?>
                    <option value="<?php echo $rowafo['complaint_state_id']; ?>"><?php echo $rowafo['complaint_state_desc']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>   
        <div class="col-md-8">
            <div class="form-group">
            <textarea name="complaint-progress-desc" class="form-control" id="" cols="30" rows="7" placeholder="รายละเอียดการดำเนินการ" required></textarea>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <div class="form-group">
            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            <input type="submit" class="btn btn-primary" value="ยืนยัน" name="complaint-state-submit">            </div>
        </div>                    

    </div>
	</form>
</div>