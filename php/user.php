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
        // $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = '" . $this->user_id . "' and user_passwd = '" . md5($this->user_passwd) . "' and user_status = 1";
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = " . $this->user_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }


     // get number of total records
     function getTotalRows(){
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }

        // create contact information
        function create(){
            // write statement
            $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (user_name, user_passwd, user_email, user_type, user_status, created_date , modified_date) VALUES (?,?,?,?,?,?,?)");
            // bind parameters
            mysqli_stmt_bind_param($stmt, 'sssssss', $this->user_name, $this->user_passwd, $this->user_email, $this->user_type, $this->user_status, $this->created_date, $this->modified_date);
    
            /* execute prepared statement */
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        }  //create()

        // update user
        function update(){
            $query = "UPDATE " . $this->table_name . " SET user_name = ?,  user_email = ?, user_type = ?, user_status = ?, created_date = ?, modified_date = ? WHERE  user_id = ?";
            // statement
            $stmt = mysqli_prepare($this->conn, $query);
            // bind parameters
            mysqli_stmt_bind_param($stmt, 'sssssss', $this->user_name, $this->user_email, $this->user_type, $this->user_status, $this->created_date, $this->modified_date, $this->user_id);
    
            /* execute prepared statement */
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        } // update()

                // update user
                function update_pwd(){
                    $query = "UPDATE " . $this->table_name . " SET user_passwd = ? WHERE  user_id = ?";
                    // statement
                    $stmt = mysqli_prepare($this->conn, $query);
                    // bind parameters
                    mysqli_stmt_bind_param($stmt, 'ss', md5($this->user_passwd), $this->user_id);
            
                    /* execute prepared statement */
                    if (mysqli_stmt_execute($stmt)) {
                        return true;
                    } else {
                        return false;
                    }
                } // update()
                
            // delete record
        function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->user_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }


}

?>