<?php
include_once "config/connection.php";

$stu_id = intval($_GET['id']);

$sql = "DELETE FROM users WHERE s_id = {$stu_id}";

$result = mysqli_query($conn, $sql) or die("Query not Run");

header("Location: index.php");
exit();
// header("Location: index.php");

?>