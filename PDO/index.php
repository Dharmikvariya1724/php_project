<?php

$db_name = "mysql:host=localhost;dbname=first";
$username = "root";
$password = "";

$conn = new PDO($db_name, $username, $password);
// $name = "WOOW";
$u_email =  "dharmikvariya@273gmail.com";
// $u_password = "789";
$id = 1;
// $sql = $conn->prepare("SELECT * FROM users");
$sql = $conn->prepare("SELECT * FROM users WHERE u_email=? AND id>? ");
// $sql = $conn->prepare("INSERT INTO users (u_name,u_email,u_password) VALUES (:name,:email,:passowrd)");

$sql->bindValue(1, $u_email);
$sql->bindParam(2, $id);
// $sql->execute(array(':name' => $name, 'email' => $u_email, 'passowrd' => $u_password));

$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);

if (count($result) > 0) {
    foreach ($result as $data) {
        // echo $data['id'];
        // echo " ";
        echo $data['u_name'];
        echo " ";
        echo $data['u_email'];
        echo "<br>";
    }
}

// while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
//     echo $row['id'];
//     echo " ";
//     echo $row['u_name'];
//     echo " ";
//     echo $row['u_email'];
//     echo "<br>";
//     // echo "<pre>";
//     // print_r($row);   
//     // echo "</pre>";
//     /*
//     PDO::FETCH_LAZY
//     PDO::FETCH_ASSOC
//     PDO::FETCH_GROUP
//     */
// }
