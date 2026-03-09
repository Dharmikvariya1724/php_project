<?php

$conn = mysqli_connect("localhost","root","","php_oop") or die("Connection Failed");

$id = $_POST['id'];

$sql = "SELECT * FROM users WHERE id = {$id}";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

echo json_encode($row);

?>