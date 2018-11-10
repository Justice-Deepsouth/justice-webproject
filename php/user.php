<?php
class User {

    //database connection and table name
    private $conn;
    private $table_name = "users";

    //table properties
    public $user_id;
    public $user_name;
    public $user_passwd;
    public $user_email;
    public $user_type;
    public $user_status;
    public $created_date;
    public $modified_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act)
    {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE user_status = 1 ORDER BY user_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY user_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = '" . $this->user_id . "' and user_passwd = '" . md5($this->user_passwd) . "' and user_status = 1";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }




}

?>