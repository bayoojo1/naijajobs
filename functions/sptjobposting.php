<?php
include("../php_includes/check_login_status.php");
include("../php_includes/mysqli_connect.php");
$howtoapply = "";
if(isset($_POST["sptjobtitle"])){
    $jobtitle = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobtitle"]);
    $compdesc = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptcompdesc"]);
    $jobdesc = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobdesc"]);
    $jobreqmt = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobreqmt"]);
    $jobcategory = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobcategory"]);
    $jobedu = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobedu"]);
    $jobrenu = preg_replace('#[^-a-z0-9@&.,/:\n ]#i', '', $_POST["sptjobrenu"]);
    $jobother = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobother"]);
    $jobloc = preg_replace('#[^a-z0-9,\'.@&:;/()\n ]#i', '', $_POST["sptjobloc"]);
    $website = preg_replace('#[^a-z0-9,.@&:/]#i', '', $_POST["sptwebsite"]);
    $jobhow = preg_replace('#[^a-z0-9;\',:&@().\n ]#i', '', $_POST["sptjobhow"]);
}

// Check what type of how to apply is given.
if(isset($website) && !empty($website)) {
    $howtoapply = $website;
} else {
    $howtoapply = $jobhow;
}

// Insert the values into the DB.
$stmt = $db_connect->prepare("INSERT INTO jobslisting (username, job_title, company_desc, job_responsibility, qualification_skill, category, education_requirement, salary, benefit, location, howtoapply, datePosted)
VALUES(:username, :job_title, :company_desc, :job_responsibility, :qualification_skill, :category, :education_requirement, :salary, :benefit, :location, :howtoapply, now())");
if($stmt->execute(array(':username' => $log_username, ':job_title' => $jobtitle, ':company_desc' => $compdesc, ':job_responsibility' => $jobdesc, ':qualification_skill' => $jobreqmt, ':category' => $jobcategory, ':education_requirement' => $jobedu, ':salary' => $jobrenu, ':benefit' => $jobother, ':location' => $jobloc, ':howtoapply' => $howtoapply))) {
    echo 'success';
}
?>
