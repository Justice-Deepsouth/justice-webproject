<?php
class Database{

    //connect to mysql database
    private $host = "localhost";
    // host on z.com
    //private $host = "localhost";
    private $user = "root";
    // database user on z.com
    //private $user = "cp506146_root";
    private $passwd = "";
    // database password on z.com
    //private $passwd = "G6uTvhz?wgUy";
    private $db_name = "justice_ds";
    // database name on z.com
    //private $db_name = "cp506146_justice_ds";
    public $conn;

    // get the database connection
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = mysqli_connect($this->host, $this->user, $this->passwd, $this->db_name);
            //mysqli_query($this->conn, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            mysqli_set_charset($this->conn, "utf8");
        }catch(Exception $exception){
            echo "Connection error: " . $exception.getMessage();
        }
        return $this->conn;
    }

    // close connection
    public function closeConnection(){
        mysqli_close($this->conn);
    }
}

?>
