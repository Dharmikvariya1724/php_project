<?php
include_once "config/connection.php";

$stu_id = intval($_GET['id']);

$sql = "SELECT * FROM users
        LEFT JOIN citys
        ON users.city_id = citys.id
        WHERE users.s_id = {$stu_id}";

$result = mysqli_query($conn, $sql) or die("Query not Run");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD | Edit User</title>
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
            <h1 class="h4 mb-0">Edit User</h1>
            <a href="index.php" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <?php if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="card form-card">
            <div class="card-body p-4">
                <form action="update_user_controller.php" method="POST">
                    <input type="hidden" name="s_id" id="s_id" value="<?php echo $row['s_id']; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $row['phone']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <?php
                            $sql1 = "SELECT * FROM citys";
                            $result1 = mysqli_query($conn, $sql1) or die("Query not Run");
                            if (mysqli_num_rows($result1) > 0) {
                                echo '<select class="form-select" name="citys_id" required>';
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    if ($row['city_id'] == $row1['id']) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value='{$row1['id']}'>{$row1['city']}</option>";
                                }
                                echo "</select>";
                            }
                        ?>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Update User</button>
                </form>
            </div>
        </div>

        <?php } ?>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
