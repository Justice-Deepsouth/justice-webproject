<?php
class User_log
{

    //database connection and table name
    private $conn;
    private $table_name = "user_logs";

    //table properties
    public $session_id;
    public $user_id;
    public $login_date;
    public $logout_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // insert
    function create()
    {
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (session_id, user_id, login_date) VALUES (?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->session_id, $this->user_id, $this->login_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    } //create()

    // update record
    function update_logout()
    {
        $query = "UPDATE " . $this->table_name . " SET logout_date = ? WHERE session_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->logout_date, $this->session_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }


        
    }//update()




}

?>