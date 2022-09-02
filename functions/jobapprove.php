<?php
include("../php_includes/check_login_status.php");
include("../php_includes/mysqli_connect.php");
include("naijajobs_functions.php");
// Gather all the variables 
$token = "1180159193:AAGmdFUATIfLWwy2jUiFWi5Anu-2aKRjz2w";
$messageType = "";
$sendMessage_url = "https://api.telegram.org/bot$token/sendMessage";
$sendPhoto_url = "https://api.telegram.org/bot$token/sendPhoto";
$sendPoll_url = "https://api.telegram.org/bot$token/sendPoll";
$sendVideo_url = "https://api.telegram.org/bot$token/sendVideo";
$sendAudio_url = "https://api.telegram.org/bot$token/sendAudio";

if(isset($_POST['status'])){
    $status = preg_replace('#[^a-z]#i', '', $_POST['status']);
    $profile_id = preg_replace('#[^0-9]#i', '', $_POST['profile_id']);
}
// Check if this job posting is already approved
$sql = "SELECT approval, dbCategory, messageType FROM jobslisting WHERE id=:id";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
$stmt->execute();
foreach($stmt->fetchAll() as $row) {
  $currentStatus = $row['0'];
  $category = $row['1'];
  $messageType = $row['2'];
}


if($currentStatus == 'Yes') {
  echo 'already_approved';
  exit();
} else {
    $sql = "UPDATE jobslisting SET approval=:status WHERE id=:id";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
    $stmt->execute();

    // Generate the hash key
    $naijajobs = $profile_id;
    $somestr = "0987654321";
    $secret = "You cannot hack this! So stop it";
    $string = trim("$naijajobs"."$somestr");
    $str1 = md5 ($string);
    $str2 = md5 ($secret);
    $hash = "$str1"."$str2";

    ?><?php
    
    $keyboard = array("inline_keyboard" => array(array(array("text" => $category,"callback_data" => $category))));

    if($messageType == "text") {
        $sql = "SELECT job_title FROM jobslisting WHERE id = :id";
        $stmt = $db_connect->prepare($sql);
        $stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $jobTitle = $row['job_title'];
        }
            // Get the chat id that indicated interest in getting alert for the above category  
            $sql = "SELECT chat_id, notify FROM notification WHERE category = :category";
            $stmt = $db_connect->prepare($sql);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    $chat_id = $row['chat_id'];
                    $notify = $row['notify'];
               
                    if($notify == 'Yes') {

                        // Form the text for Telegram
                        $text = "You have a new vacancy for the post of " . strtoupper($jobTitle) . " in the category below:";
        
                        // Update the joblisting table 
                        $sql = "UPDATE jobslisting SET hash=:hash WHERE id=:id LIMIT 1";
                        $stmt = $db_connect->prepare($sql);
                        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $profile_id, PDO::PARAM_INT);
                        $stmt->execute();
                        // Initiate Telegram sendMessage 
                        postjob($sendMessage_url,$chat_id,$text,$keyboard);
                }
            }        

        } 
    }
}                

?>
