<?php $userCount = mysqli_num_rows($users); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="page">

        <div class="hero">
            <div class="hero-title">
                <h1>User Dashboard</h1>
                <p>Register people quickly and keep their details organized.</p>
            </div>
            <div class="cta-group">
                <!-- <a class="btn btn-ghost" href="#register">Jump to form</a> -->
                <a class="btn btn-primary" href="index.php?action=create">Open form only</a>
            </div>
        </div>

        <div class="grid">

            <div class="card" id="register">
                <h3>Register User</h3>
                <!-- <p class="helper">Add a new person with their sign-in information.</p> -->

                <!-- form submit store function -->
                <form class="form-grid" method="POST" action="index.php?action=store">
                    <label class="label" for="name">Name</label>
                    <input class="input" type="text" name="name" id="name" placeholder="Jane Cooper">

                    <label class="label" for="email">Email</label>
                    <input class="input" type="email" name="email" id="email" placeholder="jane@email.com">

                    <label class="label" for="password">Password</label>
                    <input class="input" type="password" name="password" id="password" placeholder="********">

                    <div style="display:flex; gap:10px; margin-top:6px;">
                        <button class="btn btn-primary" type="submit">Register</button>
                        <!-- <a class="btn btn-ghost" href="index.php">Reset</a> -->
                    </div>
                </form>
            </div>

            <div class="card table-card">
                <div class="table-header">
                    <div>
                        <h3 style="margin:0;">User List</h3>
                        <div class="table-meta">
                            <span><?php echo $userCount; ?> user<?php echo $userCount === 1 ? '' : 's'; ?> stored</span>
                            <!-- <span class="pill">Live</span> -->
                        </div>
                    </div>
                    <div class="legend">
                        <span><span class="dot"></span>ID</span>
                        <span><span class="dot" style="background: #0ea5e9;"></span>Email</span>
                        <span><span class="dot" style="background: #22c55e;"></span>Actions</span>
                    </div>
                </div>

                <?php if ($userCount === 0) { ?>
                    <p class="helper">No users yet. Start by adding someone new.</p>
                <?php } else { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                                <tr>
                                    <!-- user id -->
                                    <td><span class="badge">#<?php echo $row['id']; ?></span></td>

                                    <!-- user name -->
                                    <td><?php echo $row['name']; ?></td>

                                    <!-- user email -->
                                    <td><?php echo $row['email']; ?></td>

                                    <td>
                                        <span class="actions">
                                            <!-- edit link -->
                                            <a href="index.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>

                                            <!-- delete link -->
                                            <a href="index.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                                        </span>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>

        </div>
    </div>
</body>

</html>