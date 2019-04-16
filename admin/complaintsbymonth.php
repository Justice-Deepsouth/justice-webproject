<?php 
    // setting header to json
    header("Content-Type: application/json");

    include_once '../php/dbconnect.php';
    include_once '../php/complaint.php';

    // get connection
	$database = new Database();
    $db = $database->getConnection();
    
    // complaints table
    $complaint = new Complaint($db);
    $result = $complaint->getComplaintsByMonth();

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    
    // free memory associated with result
    $result->close();

    // close connection
    $database->closeConnection(); 

    // now print the data
    echo json_encode($data);
?>