<?php
$stu_id = $_POST['s_id'];
$stu_name  = $_POST['name'];
$stu_phone = $_POST['phone'];
$stu_city  = $_POST['citys_id'];

include_once "config/connection.php";

$sql = "UPDATE `users` SET `name`='{$stu_name}',`phone`='{$stu_phone}',`city_id`='{$stu_city}' WHERE s_id= {$stu_id}"; 
// echo "UPDATE `users` SET `name`='{$stu_name}',`phone`='{$stu_phone}',`city_id`='{$stu_city}' WHERE sid= {$s_id}";

$result = mysqli_query($conn, $sql) or die("Query not Run");
mysqli_close($conn);
header("Location: index.php");
exit();
