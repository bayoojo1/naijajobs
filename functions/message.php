<?php
include("../php_includes/mysqli_connect.php");
if(isset($_POST["id"])){
    chatid = preg_replace('#[^0-9]#i', '', $_POST["id"]);
    $name = preg_replace('#[^-a-z0-9,\'.@_]#i', '', $_POST["name"]);
    $message = preg_replace('#[^-a-z0-9,\'.@:;/()?_=+\%\$\n ]#i', '', $_POST["message"]);
}

// Insert the values into the DB.
$stmt = $db_connect->prepare("INSERT INTO message (chat_id, name, sub_message, dateSubmitted)
VALUES(:chat_id, :name, :sub_message, now())");
if($stmt->execute(array(':chat_id' => $chatid, ':name' => $name, ':sub_message' => $message))) {
    echo 'success';
}
?>
