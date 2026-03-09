<?php
$conn = mysqli_connect("localhost","root","","php_oop") or die("Connection Failed: " . mysqli_connect_error());

$id=$_POST['id'];
$sql = "DELETE FROM users WHERE id={$id}";
// $result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}

?>