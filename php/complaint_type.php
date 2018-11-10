<?php
class Complaint_type {

    //database connection and table name
    private $conn;
    private $table_name = "complaint_types";

    //table properties
    public $complaint_type_id;
    public $complaint_type_desc;
    public $complaint_type_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act){
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_type_status = 1 ORDER BY complaint_type_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY complaint_type_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_type_id = " . $this->complaint_type_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (complaint_type_desc, complaint_type_status) VALUES (?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->complaint_type_desc, $this->complaint_type_status);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET complaint_type_desc = ?, complaint_type_status = ? WHERE complaint_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->complaint_type_desc, $this->complaint_type_status, $this->complaint_type_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE complaint_type_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->prop_type_id);

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