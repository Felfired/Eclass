<?php
session_start();
header('Content-Type: application/json');
$ID_Professor = $_SESSION['Username'];
require_once('connect.php');

$sqlQuery = "SELECT Year, count(*) AS c FROM teaching WHERE Professor = '$ID_Professor' GROUP BY Year";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
