<?php
$conn = mysqli_connect("localhost","root","","php_oop") or die("Connection Failed: " . mysqli_connect_error());

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "INSERT INTO users(name, email, phone, password) VALUES('{$name}','{$email}','{$phone}','{$password}')";
// $result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));  

if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}

?>