<?php
include("../php_includes/mysqli_connect.php");
if(isset($_POST["id"])){
    $job_id = preg_replace('#[^0-9]#i', '', $_POST["id"]);
    $email = preg_replace('#[^-a-z0-9,\'.@_]#i', '', $_POST["mail"]);
    $complaint = preg_replace('#[^a-z0-9,\'.@:;/()\n ]#i', '', $_POST["complaint"]);
}
// Pull out the job title from the id 
$sql = "SELECT job_title FROM jobslisting WHERE id = :id LIMIT 1";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':id', $job_id, PDO::PARAM_STR);
$stmt->execute();
foreach($stmt->fetchAll() as $row) {
  $jobTitle = $row['0'];
}

// Insert the values into the DB.
$stmt = $db_connect->prepare("INSERT INTO complaints (sub_email, job_id, job_title, sub_complaints, dateSubmitted)
VALUES(:sub_email, :job_id, :job_title, :sub_complaints, now())");
if($stmt->execute(array(':sub_email' => $email, ':job_id' => $job_id, ':job_title' => $jobTitle, ':sub_complaints' => $complaint))) {
    echo 'success';
}
?>
