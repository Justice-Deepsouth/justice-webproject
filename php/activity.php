<?php
class Activity {

    //database connection and table name
    private $conn;
    private $table_name = "activities";

    //table properties
    public $activity_id;
    public $activity_name;
    public $activity_desc;
    public $activity_place;
    public $activity_sdate;
    public $activity_edate;
    public $activity_image;
    public $user_id;
    public $created_date;
    public $modified_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act){
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create activity information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (activity_name, activity_desc, activity_place, activity_sdate, activity_edate, activity_image, user_id, created_date) VALUES (?,?,?,?,?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss', $this->activity_name, $this->activity_desc, $this->activity_place, $this->activity_sdate, $this->activity_edate, $this->activity_image, $this->user_id, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET activity_name = ?, activity_desc = ?, activity_place = ?, activity_sdate = ?, activity_edate = ?, activity_image = ?, user_id = ?, modified_date = ? WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->activity_name, $this->activity_desc, $this->activity_place, $this->activity_sdate, $this->activity_edate, $this->activity_image, $this->user_id, $this->modified_date, $this->activity_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->activity_id);

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