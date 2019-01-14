<?php
class Article {

    //database connection and table name
    private $conn;
    private $table_name = "articles";

    //table properties
    public $article_id;
    public $article_title;
    public $article_desc;
    public $created_date;
    public $modified_date;
    public $article_status;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall($act){
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE article_status = 1 ORDER BY article_id";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY article_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE article_id = " . $this->article_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (article_title, article_desc, article_status, created_date) VALUES (?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->article_title, $this->article_desc, $this->article_status, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET article_title = ?, article_desc = ?, article_status = ? WHERE article_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->article_title, $this->article_desc, $this->article_status, $this->article_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE article_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->article_id);

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