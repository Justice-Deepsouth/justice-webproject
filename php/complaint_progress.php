<?php

    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

class Complaint_progress
{

    //database connection and table name
    private $conn;
    private $table_name = "complaint_progresses";

    //table properties
    public $complaint_progress_id;
    public $complaint_id;
    public $complaint_progress_desc;
    public $complaint_state_id;
    public $user_id;
    public $created_date;
    public $modified_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_id = '" . $this->complaint_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_progress_id = " . $this->complaint_progress_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (complaint_id, complaint_progress_desc, complaint_state_id, user_id, created_date) VALUES (?,?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->complaint_id, $this->complaint_progress_desc, $this->complaint_state_id, $this->user_id, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET complaint_progress_desc = ?, complaint_progress_status = ? WHERE complaint_progress_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->complaint_progress_desc, $this->complaint_progress_status, $this->complaint_progress_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

     // get number of total records
     function getTotalRows(){
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }
    
}
?>