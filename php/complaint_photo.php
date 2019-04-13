<?php
class Complaint_photo
{
    //database connection and table name
    private $conn;
    private $table_name = "complaint_photos";

    //table properties
    public $complaint_photo_id;
    public $complaint_photo_name;
    public $complaint_id;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create contact information
    function create()
    {
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (complaint_photo_id,complaint_photo_name,complaint_id) VALUES (?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->complaint_photo_id, $this->complaint_photo_name, $this->complaint_id); 
        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET complaint_photo_name = ?, complaint_id = ? WHERE complaint_photo_id = ?";
            // statement
        $stmt = mysqli_prepare($this->conn, $query);
            // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->complaint_photo_name, $this->complaint_id, $this->complaint_photo_id);
    
            /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

                // delete record
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE complaint_photo_id = ?";
                    // statement
        $stmt = mysqli_prepare($this->conn, $query);
                    // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->complaint_photo_id);
            
                    /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete All record
    function deleteall()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE complaint_id = ?";
                    // statement
        $stmt = mysqli_prepare($this->conn, $query);
                    // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->complaint_id);
            
                    /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
    
     //read all records
    function readall($act)
    {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_id = '" . $this->complaint_id . "'";

        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY complaint_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

     // get number of total records
    function getTotalRows()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }
 

    //read one record
    function readone()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_photo_id = '" . $this->complaint_photo_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // get last complaint_id
    function getLast_Complaint_Photo_ID() {
        $query = "SELECT complaint_photo_id FROM	" . $this->table_name." WHERE complaint_id ='" . $this->complaint_id . "' ORDER BY complaint_photo_id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_array($result);
        $cComplaint__Photo_ID = $row['complaint_photo_id'];

            
        return $cComplaint__Photo_ID;
    }

}
?>