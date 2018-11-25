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

}

?>