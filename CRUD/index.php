<?php
include_once "config/connection.php";
$sql = "SELECT * FROM users JOIN citys WHERE users.city_id = citys.id";
$result = mysqli_query($conn, $sql) or die("Query not Run");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD | Users</title>
    <style>
        body {
            background: linear-gradient(135deg, #f2f6ff, #eefaf5);
            min-height: 100vh;
        }

        .page-wrap {
            max-width: 980px;
            margin: 0 auto;
            padding: 36px 12px;
        }

        .table-card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">User Management</h1>
            </div>
            <a href="add.php" class="btn btn-primary">Add User</a>
        </div>

        <div class="card table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">City</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="ps-4"><?php echo $i++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?php echo $row['s_id']; ?>" class="btn btn-sm btn-success me-2">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['s_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
