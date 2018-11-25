<?php
Class Setting {

    //database connection and table name
    private $conn;
    private $table_name = "settings";

    //table properties
    public $project_name;
    public $project_address;
    public $project_phone;
    public $project_email;
    public $project_website;
    public $project_twitter;
    public $project_facebook;
    public $project_youtube;
    public $complaint_id_last;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET project_name = ?, project_address = ?, project_phone = ?, project_email = ?, project_website = ?, project_twitter = ?, project_facebook = ?, project_youtube = ?, complaint_id_last = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->project_name, $this->project_address, $this->project_phone, $this->project_email, $this->project_website, $this->project_twitter, $this->project_facebook, $this->project_youtube, $this->complaint_id_last);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // update complaint_id_last
    function update_complaint_id() {
        $query = "UPDATE " . $this->table_name . " SET complaint_id_last = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 's', $this->complaint_id_last);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // get last complaint_id
    function getLast_Complaint_ID() {
        $query = "SELECT complaint_id_last FROM	" . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_array($result);
        $cComplaint_ID = $row['complaint_id_last'];
        // check whether same year
        if (substr($cComplaint_ID, 0, 4) == date("Y")) {
            //check whether same month
            if (substr($cComplaint_ID, 5, 2) == date("m")) {
                $running_no = (int)substr($cComplaint_ID, 8, 2) + 1;
                $nComplaint_ID = substr($cComplaint_ID, 0, 8) . str_pad($running_no, 2, '0', STR_PAD_LEFT);
            } else {        // start new month, running no is 01
                $cmonth = date("m");
                $nComplaint_ID = substr($cComplaint_ID, 0, 5) . str_pad($cmonth, 2, '0', STR_PAD_LEFT) . "-01";
            }
        } else {                // start new year, then month is 01 and running no is also 01 
            $cyear = date("Y");
            $nComplaint_ID = $cyear . "-01-01"; 
        }
        return $nComplaint_ID;
    }
}

?>