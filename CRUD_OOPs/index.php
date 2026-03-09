<?php
session_start();
require_once "connfig/database.php";

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}

$obj = new Query();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user by email
    $user = $obj->getData('users', '*', "email = '$email'");

    if(!empty($user)){

        // First record
        $user = $user[0];

        if($password == $user['password']){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "Incorrect Password";
        }
    } else {
        echo "Incorrect Email";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
    }

    .login-container {
        width: 350px;
        padding: 40px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        width: 400px;
        /* background: #fff; */
        padding: 35px;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: none;
        outline: none;
    }

    .input-group input:focus {
        box-shadow: 0 0 5px #fff;
    }

    .remember {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .remember a {
        text-decoration: none;
        color: #fff;
    }

    .remember a:hover {
        text-decoration: underline;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #4e73df;
        color: #333;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background: #ddd;
    }

    .register {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .register a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }

    .register a:hover {
        text-decoration: underline;
    }

    @media (max-width: 400px) {
        .login-container {
            width: 90%;
            padding: 25px;
        }
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login</h2>

        <form action="" method="post">
            <div class=" input-group">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="login" value="login" id="login" class="btn">Login</button>

            <!-- <div class="register">
                Don't have an account? <a href="Registration.php">Register</a>
            </div> -->
        </form>
    </div>

</body>

</html>