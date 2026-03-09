<?php
$stu_name  = $_POST['name'];
$stu_phone = $_POST['phone'];
$stu_city  = $_POST['citys_id'];

include_once "config/connection.php";

$sql = "INSERT INTO users (name, phone, city_id) VALUES ('{$stu_name}', '{$stu_phone}', '{$stu_city}')";

$result = mysqli_query($conn, $sql) or die("Query not Run");
mysqli_close($conn);
header("Location: index.php");
exit();
