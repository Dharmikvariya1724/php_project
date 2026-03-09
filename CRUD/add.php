<?php
include_once "config/connection.php";

$sql = "SELECT * FROM citys";
$result = mysqli_query($conn, $sql) or die("Query not Run");

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD | Add User</title>
    <style>
        body {
            background: linear-gradient(135deg, #f2f6ff, #eefaf5);
            min-height: 100vh;
        }

        .form-wrap {
            max-width: 580px;
            margin: 42px auto;
            padding: 0 12px;
        }

        .form-card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>
    <div class="form-wrap">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">Add User</h1>
            <a href="index.php" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="card form-card">
            <div class="card-body p-4">
                <form action="user_controller.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="phone" id="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="citys_Id" class="form-label">City</label>
                        <select class="form-select" name="citys_id" id="citys_Id" required>
                            <option selected disabled value="">Choose...</option>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['city']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Save User</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
