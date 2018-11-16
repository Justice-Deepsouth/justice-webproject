<?php
class Complaint_state {

    //database connection and table name
    private $conn;
    private $table_name = "complaint_states";

    //table properties
    public $complaint_state_id;
    public $complaint_state_desc;
    public $complaint_state_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act){
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_state_status = 1 ORDER BY complaint_state_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY complaint_state_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_state_id = " . $this->complaint_state_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (complaint_state_desc, complaint_state_status) VALUES (?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->complaint_state_desc, $this->complaint_state_status);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET complaint_state_desc = ?, complaint_state_status = ? WHERE complaint_state_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->complaint_state_desc, $this->complaint_state_status, $this->complaint_state_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE complaint_state_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->complaint_state_id);

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