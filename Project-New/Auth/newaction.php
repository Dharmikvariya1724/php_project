<?php

require_once 'db.php';

$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == "insert") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $db->insert($fname, $lname, $email, $phone, $password);
}

if (isset($_POST['action']) && $_POST['action'] == "login") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->login($email, $password);

    if ($user) {

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        echo "success";
    } else {
        echo "error";
    }

    header("CRUD\index.php");

}

?>
