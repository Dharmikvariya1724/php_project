
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>User Vault</title>

    <style>
        :root {
            --bg: #f6f8fb;
            --card: #ffffff;
            --stroke: #e5e7ef;
            --primary: #2563eb;
            --primary-soft: #e8efff;
            --text: #1f2a44;
            --muted: #5f6b8c;
            --success: #10b981;
            --danger: #ef4444;
            --shadow: 0 12px 40px rgba(20, 46, 110, 0.12);
        }

        * {
            font-family: 'Manrope', 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--stroke);
        }

        .brand-mark {
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .brand-dot {
            color: var(--primary);
        }

        .hero {
            padding: 32px 0 8px;
        }

        .hero h1 {
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }

        .hero p {
            color: var(--muted);
            max-width: 640px;
            font-size: 15px;
        }

        .card-shell {
            background: var(--card);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            border-radius: 14px;
            padding: 18px;
        }

        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            font-weight: 700;
            padding-inline: 18px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.18);
        }

        .btn-primary:hover {
            filter: brightness(1.05);
        }

        .btn-outline-light {
            border-color: var(--stroke);
            color: var(--text);
            background: #ffffff;
        }

        table.dataTable {
            color: var(--text);
            border-collapse: separate !important;
            border-spacing: 0 8px !important;
        }

        table.dataTable thead th {
            background: var(--primary-soft);
            border: none;
            color: var(--text);
            font-weight: 700;
        }

        table.dataTable tbody tr {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 0 var(--stroke);
        }

        table.dataTable tbody tr td {
            border: none;
        }

        table.dataTable tbody tr td:first-child,
        table.dataTable thead th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        table.dataTable tbody tr td:last-child,
        table.dataTable thead th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .badge-soft {
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 600;
            font-size: 12px;
        }

        .form-control {
            background: #f9fafb;
            border: 1px solid var(--stroke);
            color: var(--text);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .modal-content {
            background: #ffffff;
            color: var(--text);
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
        }

        .modal-header,
        .modal-footer {
            border-color: var(--stroke);
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .pill {
            width: 6px;
            height: 24px;
            border-radius: 12px;
            background: var(--primary);
            opacity: 0.85;
        }

        .footer-hint {
            color: var(--muted);
            font-size: 13px;
            margin-top: 16px;
            text-align: center;
        }

        .dataTables_wrapper .dataTables_filter input {
            background: #f9fafb;
            color: var(--text);
            border: 1px solid var(--stroke);
            border-radius: 10px;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            color: var(--text);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: var(--text) !important;
            border-radius: 10px;
            background: #eef1f7 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            color: #fff !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand brand-mark" href="#">User Vault<span class="brand-dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <span class="badge-soft">Realtime CRUD</span>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add user</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <section class="hero">
            <h1 class="display-5">User Listing</h1>
        </section>

        <div class="glass-card">
            <div class="action-bar">
                <div class="table-title">
                    <span class="pill"></span>
                    <span>People</span>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" id="refresh">Refresh</button>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add user</button>
                </div>
            </div>
            <!-- Table Load -->
            <div class="table-responsive" id="showUser"></div>
        </div>
    </main>

    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="" id="form-data">
                        <div class="mb-3">
                            <label for="fname" class="form-label">First name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Jane" required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="jane@company.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="(555) 123-4567" required>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name="insert" id="insert">Save user</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="post" action="" id="edit-form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="f_name" class="form-label">First name</label>
                            <input type="text" class="form-control" name="fname" id="f_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="l_name" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lname" id="l_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="e_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="e_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="e_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="e_phone" required>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" name="update" id="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#showUser").html(response);
                        $('table').DataTable({
                            destroy: true,
                            pageLength: 5,
                            lengthMenu: [5, 10, 25],
                            order: [[0, 'desc']]
                        });
                    }
                });
            }

            $("#refresh").on('click', function() {
                showAllUsers();
            });

            $("#insert").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function() {
                        Swal.fire({
                            title: 'User added',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $("#exampleModal").modal('hide');
                        $("#form-data")[0].reset();
                        showAllUsers();
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

            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();
                const edit_id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        $("#id").val(data.id);
                        $("#f_name").val(data.fname);
                        $("#l_name").val(data.lname);
                        $("#e_email").val(data.email);
                        $("#e_phone").val(data.phone);
                    }
                });
            });

            $("#update").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: $("#edit-form-data").serialize() + "&action=update",
                    success: function() {
                        Swal.fire({
                            title: 'User updated',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $("#exampleEditModal").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllUsers();
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

            $("body").on("click", ".deleteBtn", function(e) {
                e.preventDefault();
                const del_id = $(this).attr('id');
                Swal.fire({
                    title: "Delete this user?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "action.php",
                            data: {
                                del_id: del_id
                            },
                            success: function() {
                                Swal.fire({
                                    title: 'Deleted',
                                    icon: 'success',
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                                showAllUsers();
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Something went wrong!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
