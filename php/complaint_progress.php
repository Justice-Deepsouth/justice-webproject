<?php

// set current timezone
date_default_timezone_set("Asia/Bangkok");

class Complaint_progress
{
    //database connection and table name
    private $conn;
    private $table_name = "complaint_progresses";
    private $complaint_table_name = "complaints";
    private $user_table_name = "users";

    //table properties
    public $complaint_progress_id;
    public $complaint_id;
    public $complaint_progress_desc;
    public $complaint_state_id;
    public $user_id;
    public $created_date;
    public $modified_date;

    //for sending email
    public $receiver_name;
    public $receiver_email;
    public $complaint_title;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records
    function readall(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_id = '" . $this->complaint_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE complaint_progress_id = " . $this->complaint_progress_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (complaint_id, complaint_progress_desc, complaint_state_id, user_id, created_date) VALUES (?,?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->complaint_id, $this->complaint_progress_desc, $this->complaint_state_id, $this->user_id, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET complaint_progress_desc = ? WHERE complaint_progress_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->complaint_progress_desc, $this->complaint_progress_id);

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
    
    function getLast_user() {
        $query = "SELECT * FROM	" . $this->table_name ." WHERE complaint_id ='" . $this->complaint_id . "' ORDER BY complaint_progress_id DESC LIMIT 1";
        $result = mysqli_query($this->conn, $query);
            
        return $result;
    }

    function send_email_progress() {
        ini_set("include_path", '/home/cp506146/php:' . ini_get("include_path"));
        require_once 'Mail.php'; //this loads up PEAR Mail
        if (!class_exists('Mail')) { die('Error: The PEAR Mail class does not exist.'); }
    
        $host = 'ssl://justicedeepsouth.in.th';
        $username = 'admin@justicedeepsouth.in.th'; //replace this with your new Gmail address
        $password = '1Uvl7DkqT2Pg'; //replace this with your new Gmail account password
        $port = '465';
    
        $from_email = $username;
        $from = '"โครงการสร้างความยุติธรรมจากความหลากหลาย" <'.$from_email.'>'; //put your name in here, but keep the double quotes
        //$to = '"Test Name" <ruchy.tts@gmail.com>'; //put in your name and main email address to send a test to
        $to = "\"" . $this->receiver_name . "\" <" . $this->receiver_email . ">";
        $subject = "สถานะการดำเนินการ";
        $body = "<div>เรียน คุณ" . $this->receiver_name . "</div><br />";
        $body .= "<p>ข้อร้องเรียน \"". $this->complaint_title . "\" มีการแก้ไขสถานะการดำเนินการ ท่านสามารถดูรายละเอียดสถานะการดำเนินการได้โดยการลงชื่อเข้าใช้งานที่เว็บไซต์ <a href='https://www.justicedeepsouth.in.th/'>https://www.justicedeepsouth.in.th/</a></p>";
        $body .= "<br />";
        $body .= "<div>ขอบคุณครับ</div>";
        $body .= "<div>Diversity Justices Project</div>";
        $body .= "โครงการสร้างความยุติธรรมจากความหลากหลาย";
    
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject,
            'Reply-To' => $from_email,
            'MIME-Version' => 1,
            'Content-type' => 'text/html;UTF-8'
        );
    
        $params = array(
            'host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password
        );
    
        $smtp = Mail::factory('smtp', $params);
        //echo '<p>Preparing to send the test message...</p>';
    
        $mail = $smtp->send($to, $headers, $body);
    
        if (PEAR::isError($mail)) {
            //echo '<p>Error! '.$mail->getMessage().'</p>';
            return false;
        } else {
            //echo '<p>Your test message was sent successfully.</p>';
            return true;
        }
    }

}
?>