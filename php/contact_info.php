<?php
class Contact_info {

    //database connection and table name
    private $conn;
    private $table_name = "contact_info";

    //table properties
    public $contact_info_id;
    public $contact_info_name;
    public $contact_info_email;
    public $contact_info_desc;
    public $check_read;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act){
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_type_status = 1 ORDER BY complaint_type_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY contact_info_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE contact_info_id = " . $this->complaint_type_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (contact_info_name, contact_info_email, contact_info_desc) VALUES (?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss',$this->contact_info_name, $this->contact_info_email, $this->contact_info_desc);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET check_read = ? WHERE contact_info_id = ? ";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->check_read, $this->contact_info_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE contact_info_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->contact_info_id);

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