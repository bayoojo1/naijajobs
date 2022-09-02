<?php
include("../php_includes/check_login_status.php");
include("../php_includes/mysqli_connect.php");

if(isset($_POST["jobtitle"])){
    $jobtitle = preg_replace('#[^a-z0-9,\'.@\&\#\%:;/() ]#i', '', $_POST["jobtitle"]);
    $jobdesc = preg_replace('#[^a-z0-9,\'.@&\#:;/()\n ]#i', '', $_POST["jobdesc"]);
    $jobreqmt = preg_replace('#[^a-z0-9,\'.@&\#:;/()\n ]#i', '', $_POST["jobreqmt"]);
    $jobcategory = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["jobcategory"]);
    $jobedu = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["jobedu"]);
    $jobrenu = preg_replace('#[^a-z0-9@&./: ]#i', '', $_POST["jobrenu"]);
    $jobother = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["jobother"]);
    $jobloc = preg_replace('#[^a-z0-9,\'.@&:;/() ]#i', '', $_POST["jobloc"]);
    $website = preg_replace('#[^a-z]#i', '', $_POST["website"]);
    $jobhow = preg_replace('#[^a-z0-9;\',:&@(). ]#i', '', $_POST["jobhow"]);
}
// Check if website is checked and fetch website of the poster
if($website == 'website') {
    $sql = "SELECT website from users WHERE username = :logusername";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':logusername', $log_username, PDO::PARAM_STR);
    $stmt->execute();
    
    foreach($stmt->fetchAll() as $row) {
      $websiteUrl = $row['0'];
    }
}
// Check what type of how to apply is given.
$howtoapply = '';
if(isset($websiteUrl) && !empty($websiteUrl)) {
    $howtoapply = $websiteUrl;
} else {
    $howtoapply = $jobhow;
}
// Generate human readable posted date 
$nowdate = date('Y-m-d');
$readable_date = date("F d, Y",strtotime($nowdate));

// Insert the values into the DB.
$stmt = $db_connect->prepare("INSERT INTO jobslisting (username, job_title, job_responsibility, qualification_skill, category, education_requirement, salary, benefit, location, howtoapply, readableDate, datePosted)
VALUES(:username, :job_title, :job_responsibility, :qualification_skill, :category, :education_requirement, :salary, :benefit, :location, :howtoapply, :readableDate, now())");
if($stmt->execute(array(':username' => $log_username, ':job_title' => $jobtitle, ':job_responsibility' => $jobdesc, ':qualification_skill' => $jobreqmt, ':category' => $jobcategory, ':education_requirement' => $jobedu, ':salary' => $jobrenu, ':benefit' => $jobother, ':location' => $jobloc, ':howtoapply' => $howtoapply, ':readableDate' => $readable_date))) {
    echo 'success';
}
?>
