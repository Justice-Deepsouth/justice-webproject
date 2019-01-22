<?php
class Activity
{

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
    public $strDate;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read all records
    // function readall($act)
    // {
    //     if ($act) {
    //         $query = "SELECT * FROM " . $this->table_name .   " WHERE activity_id = '" . $this->user_id . "' ORDER BY activity_name desc";
    //     } else {
    //         $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC";
    //     }
    //     $result = mysqli_query($this->conn, $query);
    //     return $result;
    // }
            //page
    function readall()
    {
        
                // define how many results you want per page
        $results_per_page = 10;
        // determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        } 
                // determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id ORDER BY activity_name DESC LIMIT  $this_page_first_result , $results_per_page ";
        $result = mysqli_query($this->conn, $query);
        return $result;
    } //read all complainant

 

    //read one record
    function readone()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE activity_id = " . $this->activity_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create activity information
    function create()
    {
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
    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET activity_name = ?, activity_desc = ?, activity_place = ?, activity_sdate = ?, activity_edate = ?,  user_id = ?, modified_date = ? WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssss', $this->activity_name, $this->activity_desc, $this->activity_place, $this->activity_sdate, $this->activity_edate, $this->user_id, $this->modified_date, $this->activity_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // update image
    function update_image()
    {
        $query = "UPDATE " . $this->table_name . " SET activity_image = ?, user_id = ?, modified_date = ? WHERE activity_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->activity_image, $this->user_id, $this->modified_date, $this->activity_id);

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
    function getTotalRows()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result);
    }

    //search all
    function search($act)
    {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE activity_name like'%" . $this->activity_name . "%' ";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }//search all

    function DateThai($strDate)
    {
        $newDate = date("d-M-Y", strtotime($strDate));
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        $strDate = "$strDay $strMonthThai $strYear";
        return $strDate;
    }
            // get last complaint_id
    function getLast_Activity_ID()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_array($result);
        $LastActivity_ID = $row['activity_id'];

        $query_last = "SELECT * FROM " . $this->table_name . " WHERE NOT activity_id = '" . $LastActivity_ID . "'ORDER BY activity_id DESC LIMIT 3";
        $result_last = mysqli_query($this->conn, $query_last);
                // $data = mysqli_fetch_array($result_last); 
                // $TripleActivity_ID = $data['activity_id'];  
        return $result_last;
    }

         //read all records
    function readone_index()
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

                  //read all records
    function read_interestACT()
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY activity_id DESC LIMIT 10";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}

?>