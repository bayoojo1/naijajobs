<?php
include("../php_includes/check_login_status.php");
include("../php_includes/mysqli_connect.php");
if (isset($_GET["status"])){
    $status = $_GET["status"];
}


if($status == "Save"){
  $id = $_GET['id'];
  $value = $_GET['value'];


if(strpos($id, 'bizname_') !== false) {
    $sql = "UPDATE users SET company=:value WHERE username=:logusername";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->bindParam(':logusername', $log_username, PDO::PARAM_STR);
    $stmt->execute();
    $db_connect = null;
} else if(strpos($id, 'website_') !== false) {
    $sql = "UPDATE users SET website=:value WHERE username=:logusername";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->bindParam(':logusername', $log_username, PDO::PARAM_STR);
    $stmt->execute();
    $db_connect = null;
} else if(strpos($id, 'bizdescription_') !== false) {
    $sql = "UPDATE users SET about=:value WHERE username=:logusername";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->bindParam(':logusername', $log_username, PDO::PARAM_STR);
    $stmt->execute();
    $db_connect = null;
    } 
}
  

?>
