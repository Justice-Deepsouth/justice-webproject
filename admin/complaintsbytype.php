<?php 
    // setting header to json
    header("Content-Type: application/json");

    include_once '../php/dbconnect.php';
    include_once '../php/complaint.php';
    include_once '../php/complaint_type.php';

    // get connection
	$database = new Database();
    $db = $database->getConnection();
    
    // complaints table
    $complaint = new Complaint($db);
    $result = $complaint->getComplaintsByType();

    // complaint_types table
    $complaint_type = new Complaint_type($db);

    $data = array();
    foreach ($result as $row) {
        // get complaint_type_desc
        $complaint_type->complaint_type_id = $row['complaint_type_id'];
        $result_ctype = $complaint_type->readone();
        $row_ctype = mysqli_fetch_array($result_ctype);
        $data[] = array(
            'complaint_type_id' => $row['complaint_type_id'],
            'complaint_type_desc' => $row_ctype['complaint_type_desc'],
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