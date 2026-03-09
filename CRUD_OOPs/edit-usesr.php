<?php
require_once "connfig/database.php";

$obj = new Query();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = $obj->getData('users', "*", "id = $id");
    $user = $user[0];
}

// Update Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageName = $user['image'];
    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmpName   = $_FILES['image']['tmp_name'];
        $uploadDir = "uploads/" . $imageName;
        move_uploaded_file($tmpName, $uploadDir);
    }
    $data = [
        'name'  => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password'],
        'image' => $imageName
    ];

    if ($obj->updateData('users', $data, "id = $id")) {
        header("Location: dashboard.php");
        exit;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registration Form</title>
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

    .container {
        width: 400px;
        background: #fff;
        padding: 35px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    .input-group input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
    }

    .gender {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #4e73df;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background: #2e59d9;
    }

    .login-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .login-link a {
        text-decoration: none;
        color: #4e73df;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    @media(max-width:450px) {
        .container {
            width: 90%;
            padding: 25px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create User</h2>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?= $user['name'] ?>" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" required>
            </div>

            <div class="input-group">
                <label>Phone Number</label>
                <input type="phone" name="phone" value="<?= $user['phone'] ?>" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" value="<?= $user['password'] ?>" placeholder="Enter Password"
                    required>
            </div>

            <div class="input-group">
                <label>Add Image</label>
                <input type="file" name="image" placeholder="Add Image" multiple>
            </div>

            <button type="submit" class="btn">Update</button>

            <!-- <div class="login-link">
                Already have an account? <a href="#">Login</a>
            </div> -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>