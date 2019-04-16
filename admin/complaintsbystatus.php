<?php 
    // setting header to json
    header("Content-Type: application/json");

    include_once '../php/dbconnect.php';
    include_once '../php/complaint.php';
    include_once '../php/complaint_state.php';

    // get connection
	$database = new Database();
    $db = $database->getConnection();
    
    // complaints table
    $complaint = new Complaint($db);
    $result = $complaint->getComplaintsByStatus();

    // complaint_types table
    $complaint_state = new Complaint_state($db);

    $data = array();
    $i = 0;
    foreach ($result as $row) {
        // get complaint_state_desc
        $complaint_state->complaint_state_id = $row['complaint_state_id'];
        $result_cstate = $complaint_state->readone();
        $row_cstate = mysqli_fetch_array($result_cstate);
        $data[] = array(
            'complaint_state_id' => $row['complaint_state_id'],
            'complaint_state_desc' => $row_cstate['complaint_state_desc'],
            'comp_amt' => $row['comp_amt']
        );
    }
    
    // free memory associated with result
    $result->close();

    // close connection
    $database->closeConnection(); 

    // now print the data
    echo json_encode($data);
?>