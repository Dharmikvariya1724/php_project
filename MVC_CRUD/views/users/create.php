<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="page">
        <div class="hero">
            <div class="hero-title">
                <h1>Create User</h1>
                <p>Open the dedicated form to add a new person.</p>
            </div>
            <div class="cta-group">
                <a class="btn btn-ghost" href="index.php">Back to dashboard</a>
            </div>
        </div>

        <div class="card" id="register">
            <h3>Register User</h3>
            <p class="helper">Enter details below to add the user.</p>

            <!-- form submit store function àª®àª¾àª‚ àªœàª¶à«‡ -->
            <form class="form-grid" method="POST" action="index.php?action=store">
                <label class="label" for="name">Name</label>
                <input class="input" type="text" name="name" id="name" placeholder="Jane Cooper">

                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" placeholder="jane@email.com">

                <label class="label" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="••••••••">

                <div style="display:flex; gap:10px; margin-top:6px;">
                    <button class="btn btn-primary" type="submit">Register</button>
                    <a class="btn btn-ghost" href="index.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>