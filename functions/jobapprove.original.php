<?php
include("../php_includes/check_login_status.php");
include("../php_includes/mysqli_connect.php");
include("naijajobs_functions.php");
// Gather all the variables 
$token = "905684105:AAEGtV8_rp-wjzpub40LucuaUJS4FLaQ_Uw";
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
$sql = "SELECT approval, category, messageType FROM jobslisting WHERE id=:id";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
$stmt->execute();
foreach($stmt->fetchAll() as $row) {
  $currentStatus = $row['0'];
  $category = $row['category'];
  $messageType = $row['messageType'];
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
  
    
if($messageType == 'text') {
// Start the process of sending message to Telegram
$text = "";
$sql = "SELECT jobslisting.id, job_title, company_desc, job_responsibility, qualification_skill, education_requirement, benefit, location, howtoapply, salary, datePosted, users.username, users.company, users.about FROM jobslisting INNER JOIN users ON users.username = jobslisting.username WHERE jobslisting.id = :id";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
$stmt->execute();
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $job_id = $row['id'];
    $username = $row['username'];
    $jobTitle = $row['job_title'];
    $comp_description = $row['company_desc'];
    $job_desc = $row['job_responsibility'];
    $skill_reqmt = $row['qualification_skill'];
    $edu_reqmt = $row['education_requirement'];
    $benefit = $row['benefit'];
    $location = $row['location'];
    $howtoapply = $row['howtoapply'];
    $salary = $row['salary'];
    $companyName = $row['company'];
    $about = $row['about'];
    $datePosted = $row['datePosted'];
    }
// Define inline keyboard to report this job 
$keyboard = array("inline_keyboard" => array(array(array("text" => "Report this job","url" => "www.naijajobsarena.com/reportjob/$jobTitle/$job_id/$hash"))));

// Get the chat id that indicated interest in getting alert for the above category  
$sql = "SELECT chat_id, Firstname as category, Username as notify FROM telegram_users WHERE chat_id NOT IN(SELECT chat_id FROM notification) UNION SELECT chat_id, category, notify FROM notification WHERE category = :category";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->execute();
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $chat_id = $row['chat_id'];
    $notify = $row['notify'];
    
    if($notify == 'Yes') {
    // Form the text for Telegram
    $text .= '<b><u>Job Title:</u></b> ' .$jobTitle;
    if(isset($comp_description) && !empty($comp_description)){
    $text .= '<b><u>About Us:</u></b> ' .$comp_description;
    } else {
        $text .= '<b><u>About Us:</u></b> ' .$about;
    }
    $text .= '<b><u>Job Description:</u></b> ' .$job_desc;
    if(isset($skill_reqmt) && !empty($skill_reqmt)) {
    $text .= '<b><u>Other Skills:</u></b> ' .$skill_reqmt;
    }
    if(isset($edu_reqmt) && !empty($edu_reqmt)) {
    $text .= '<b><u>Educational Requirement:</u></b> ' .$edu_reqmt;
    }
    $text .= '<b><u>Job Location:</u></b> ' .$location;
    if(isset($benefit) && !empty($benefit)) {
    $text .= '<b><u>Other Benefits</u></b> ' .$benefit;
    }
    if(isset($salary) && !empty($salary)) {
    $text .= '<b><u>Renumeration:</u></b> ' .$salary;
    }
    $text .= '<b><u>To Apply:</u></b>';
    if(filter_var('http://'.$howtoapply, FILTER_VALIDATE_URL)) {
    $text .= 'Visit our website: ' .$howtoapply;
    } else {
    $text .= $howtoapply; 
    }
    $text .= '<b><u>Date Posted:</u></b>' .$datePosted;
    // Update the joblisting table 
    $sql = "UPDATE jobslisting SET hash=:hash WHERE id=:id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':id', $job_id, PDO::PARAM_INT);
    $stmt->execute();
    // Initiate Telegram sendMessage 
    postjob($sendMessage_url,$chat_id,$text,$keyboard);
    exit();
    } else if($notify != 'Yes') {    
    $text = "";
    $sql = "SELECT jobslisting.id, job_title, company_desc, job_responsibility, qualification_skill, education_requirement, benefit, location, howtoapply, salary, datePosted, users.username, users.company, users.about FROM jobslisting INNER JOIN users ON users.username = jobslisting.username WHERE jobslisting.id = :id";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':id', $profile_id, PDO::PARAM_STR);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $job_id = $row['id'];
        $username = $row['username'];
        $jobTitle = $row['job_title'];
        $comp_description = $row['company_desc'];
        $job_desc = $row['job_responsibility'];
        $skill_reqmt = $row['qualification_skill'];
        $edu_reqmt = $row['education_requirement'];
        $benefit = $row['benefit'];
        $location = $row['location'];
        $howtoapply = $row['howtoapply'];
        $salary = $row['salary'];
        $companyName = $row['company'];
        $about = $row['about'];
        $datePosted = $row['datePosted'];
        }
    // Define inline keyboard to report this job 
    $keyboard = array("inline_keyboard" => array(array(array("text" => "Report this job","url" => "www.naijajobsarena.com/reportjob/$jobTitle/$job_id/$hash"))));

    // Get chat id
    $sql = "SELECT chat_id, Firstname as category, Username as notify FROM telegram_users WHERE chat_id NOT IN(SELECT chat_id FROM notification) UNION SELECT chat_id, category, notify FROM notification WHERE notify != 'Yes'";
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $chat_id = $row['chat_id'];

    // Form the text for Telegram
    $text .= '<b><u>Job Title:</u></b> ' .$jobTitle;
    if(isset($comp_description) && !empty($comp_description)){
    $text .= '<b><u>About Us:</u></b> ' .$comp_description;
    } else {
        $text .= '<b><u>About Us:</u></b> ' .$about;
    }
    $text .= '<b><u>Job Description:</u></b> ' .$job_desc;
    if(isset($skill_reqmt) && !empty($skill_reqmt)) {
    $text .= '<b><u>Other Skills:</u></b> ' .$skill_reqmt;
    }
    if(isset($edu_reqmt) && !empty($edu_reqmt)) {
    $text .= '<b><u>Educational Requirement:</u></b> ' .$edu_reqmt;
    }
    $text .= '<b><u>Job Location:</u></b> ' .$location;
    if(isset($benefit) && !empty($benefit)) {
    $text .= '<b><u>Other Benefits</u></b> ' .$benefit;
    }
    if(isset($salary) && !empty($salary)) {
    $text .= '<b><u>Renumeration:</u></b> ' .$salary;
    }
    $text .= '<b><u>To Apply:</u></b>';
    if(filter_var('http://'.$howtoapply, FILTER_VALIDATE_URL)) {
    $text .= 'Visit our website: ' .$howtoapply;
    } else {
    $text .= $howtoapply; 
    }
    $text .= '<b><u>Date Posted:</u></b>' .$datePosted;
    // Update the joblisting table 
    $sql = "UPDATE jobslisting SET hash=:hash WHERE id=:id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':id', $job_id, PDO::PARAM_INT);
    $stmt->execute();
    // Initiate Telegram sendMessage 
    postjob($sendMessage_url,$chat_id,$text,$keyboard);
                }       
            }
        }
    }                
}

?>
