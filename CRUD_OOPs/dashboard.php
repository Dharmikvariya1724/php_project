<?php
session_start();
require_once "connfig/database.php";

$obj = new Query();
$users = $obj->getData('users', '*');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Insert Data In Database Using Form(Post) 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imageName = "";
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

    if ($obj->insertData('users', $data)) {
        header("Location: dashboard.php");
        exit;
    }
}

// Delete Data In Database Using Form(Post) 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if ($obj->deleteData('users', "id = $id")) {
        header("Location: dashboard.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(125deg, #4e73df, #1cc88a);
        }

        .container {
            margin-top: 30px;
        }

        /* Form Styling */
        .form-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;

        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        .btn-submit {
            width: 100%;
            background: #4e73df;
            color: #fff;
            font-weight: 500;
        }

        .btn-submit:hover {
            background: #2e59d9;
        }

        /* Table Styling */
        .table-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .table-card h4 {
            margin-bottom: 15px;
        }

        .table thead th {
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .logout:hover {
            background: darkred;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Form Card -->
        <!-- <center>
            <div class="form-card col-4">
                <h2>Create User</h2>
                <form method="post" action="">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" placeholder="Enter Phone Number" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Register</button>
                </form>
            </div>
        </center> -->

        <!-- Table Card -->
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>User List</h4>
                <div class="d-flex gap-2">
                    <a href="add-user.php" class="btn btn-success btn-sm">Add User</a>
                    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No:</th>
                            <th>Image:</th>
                            <th>Name :</th>
                            <th>Email :</th>
                            <th>Phone No :</th>
                            <th>Action :</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) { ?>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="uploads/<?= $user['image'] ?>" width="60" height="60"></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['phone'] ?></td>
                                    <td>
                                        <a href="edit-usesr.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="dashboard.php?delete=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5">No users found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>