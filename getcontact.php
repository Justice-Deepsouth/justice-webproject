<?php

    include_once 'php/dbconnect.php';
    include_once 'php/complaint_type.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $complaint_type = new Complaint_type($db);

    // read one records
    $complaint_type->complaint_type_id = $_POST['type_id'];
    $result = $complaint_type->readone();
    $row = mysqli_fetch_array($result);
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<td><?php echo $row['complaint_type_id']; ?></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><?php echo $row['complaint_type_desc']; ?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo $row['complaint_type_status']; ?></td>
		</tr>
	</table>
</div>
