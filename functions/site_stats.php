<?php 

include("/var/www/naijajobs/html/php_includes/mysqli_connect.php");

$sql = "SELECT category, COUNT(id) FROM category_clicks WHERE date(dateClicked) = curdate() GROUP BY category";
$stmt = $db_connect->prepare($sql);
$stmt->execute();
foreach($stmt->fetchAll() as $row) {
    $category = $row['0'];
    $count_id = $row['1'];


// Insert the values into the DB.
$stmt = $db_connect->prepare("INSERT INTO site_stats (category, count_id, dateRecorded)
VALUES(:category, :count_id, now())");
$stmt->execute(array(':category' => $category, ':count_id' => $count_id));
}
?>