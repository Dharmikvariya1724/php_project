<?php
$conn = mysqli_connect("localhost","root","","php_oop") or die("Connection Failed: " . mysqli_connect_error());

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email']; 
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "UPDATE users SET name='{$name}',email='{$email}',phone='{$phone}',password='{$password}' WHERE id={$id}";
if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}

?>