<?php

// result array convert
$data = mysqli_fetch_assoc($user);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="page">
        <div class="hero">
            <div class="hero-title">
                <h1>Edit User</h1>
                <p>Update details for the selected record.</p>
            </div>
            <div class="cta-group">
                <span class="badge">ID #<?php echo $data['id']; ?></span>
                <a class="btn btn-ghost" href="index.php">Back to dashboard</a>
            </div>
        </div>

        <div class="card" id="register">
            <h3>Update Information</h3>
            <p class="helper">Change the user name or email as needed.</p>

            <form class="form-grid" method="POST" action="index.php?action=update&id=<?php echo $data['id']; ?>">
                <label class="label" for="name">Name</label>
                <input class="input" type="text" name="name" id="name" value="<?php echo $data['name']; ?>" placeholder="Jane Cooper">

                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" value="<?php echo $data['email']; ?>" placeholder="jane@email.com">

                <div style="display:flex; gap:10px; margin-top:6px;">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a class="btn btn-ghost" href="index.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>