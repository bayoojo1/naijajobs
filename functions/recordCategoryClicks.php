<?php
function recordCategoryClicks($callback_data,$chat_id) {
    include("../php_includes/mysqli_naijajobs_connect.php");
    //Store data into the DB
    $stmt = $db_connect->prepare("INSERT INTO category_clicks (chat_id, category, dateClicked)
VALUES(:chat_id, :category, now())");
$stmt->execute(array(':chat_id' => $chat_id, ':category' => $callback_data))   
}
?>