<?php
header('Content-Type: application/json');

include("../php_includes/mysqli_connect.php");

//$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";
$sql = "SELECT category, COUNT(id) FROM category_clicked WHERE date(date_Clicked) = curdate() GROUP BY category";
$stmt = $db_connect->prepare($sql);
//$stmt->bindParam(':id', $job_id, PDO::PARAM_STR);
$stmt->execute();


//$result = mysqli_query($conn,$sqlQuery);

$data = array();
//foreach ($result as $row) {
//	$data[] = $row;
//}

foreach($stmt->fetchAll() as $row) {
  $data[] = $row;
}

//mysqli_close($conn);

echo json_encode($data);
?>