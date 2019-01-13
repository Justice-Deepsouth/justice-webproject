<?php
    session_start();
	
    // set current timezone
    date_default_timezone_set("Asia/Bangkok");

    include_once '../php/dbconnect.php';
    include_once '../php/article.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_states table
	$article = new Article($db);
    $article->article_id = $_POST['article_id'];
    $result = $article->readone();
    $row = mysqli_fetch_array($result);

?>
<div class="table-responsive">
	<?php echo $row['article_desc']; ?>
</div> 