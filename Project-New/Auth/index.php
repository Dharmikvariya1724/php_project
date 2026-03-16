<?php

session_start();
// $_SESSION['user_id'] = $user['id'];
// $_SESSION['email'] = $user['email'];

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Sign in</title>

    <style>
        :root {
            --bg: #f6f8fb;
            --card: #ffffff;
            --stroke: #e5e7ef;
            --primary: #2563eb;
            --muted: #5f6b8c;
        }

        * {
            font-family: 'Manrope', 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.12), transparent 26%),
                radial-gradient(circle at 80% 10%, rgba(37, 99, 235, 0.08), transparent 24%),
                var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-shell {
            width: min(960px, 100%);
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 24px;
            align-items: stretch;
        }

        .hero {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #f8f9ff;
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.28);
        }

        .hero h1 {
            font-weight: 800;
            margin-bottom: 12px;
        }

        .hero p {
            color: #e5eaff;
            max-width: 520px;
        }

        .card {
            border: 1px solid var(--stroke);
            border-radius: 18px;
            box-shadow: 0 20px 60px rgba(17, 24, 39, 0.08);
        }

        .form-text {
            color: var(--muted);
        }

        .form-control {
            background: #f9fafb;
            border: 1px solid var(--stroke);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .link-muted {
            color: var(--muted);
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }
            .hero {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="hero">
            <h1>Welcome back</h1>
            <p>Sign in to update your user directory. Your credentials are encrypted and never shared.</p>
            <ul class="mt-4 mb-0">
                <li>• Instant redirect after login</li>
                <li>• Friendly alerts for success and errors</li>
                <li>• Keyboard-first form (Enter to submit)</li>
            </ul>
        </div>

        <div class="card p-4">
            <div class="mb-3">
                <span class="badge bg-primary-soft text-primary" style="background:#e8efff;color:#2563eb;">Login</span>
            </div>
            <h2 class="h4 mb-2">Access your account</h2>
            <p class="text-muted mb-4">Use the email you registered with to continue.</p>
            <form method="post" action="" id="login-form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" checked>
                        <label class="form-check-label" for="remember">Stay signed in</label>
                    </div>
                    <a href="#" class="link-muted small">Forgot password?</a>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a class="btn btn-outline-secondary" href="ragistrection.php">Create an account</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

<script>
    $(document).ready(function() {

        $("#login-form-data").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "newaction.php",
                data: $(this).serialize() + "&action=login",
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Login Successfuly',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $("#login-form-data")[0].reset();
                    
                    setTimeout(function() {
                        window.location.href = "../CRUD/index.php";
                    }, 1500);
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong!',
                        icon: 'error'
                    });
                }
            });
        });

    });
</script>

</html>
