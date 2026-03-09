<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajax-PHP CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      text-align: center;
      margin: 30px 0;
      color: #0d6efd;
    }

    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
    }

    #table-data th,
    #table-data td {
      vertical-align: middle;
    }
  </style>
</head>

<body>

  <h1>Ajax-PHP</h1>

  <div id="error-messge"></div>
  <div id="success-messge"></div>
  <div class="container">

    <div class="row justify-content-center">

      <!-- Form Card -->
      <div class="col-lg-5 col-md-6 mb-4">
        <div class="card p-4">
          <h4 class="mb-3 text-center">Add User</h4>
          <form id="userForm">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Name">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email">
            </div>
            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <button type="button" id="submit" class="btn btn-primary w-100">Save</button>
          </form>
        </div>
      </div>

      <!-- Table Card -->
      <div class="col-lg-7 col-md-8">
        <div class="card p-3">
          <h4 class="mb-3 text-center">User List</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-data">
              <!-- Data will load here via AJAX -->
            </table>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="mb-3 text-center">Add User</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <div class="card p-4">

                  <form id="userForm">
                    <input type="hidden" id="id">
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" id="edit_name" name="edit_name" value="" placeholder="Enter Name">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control" id="edit_email" name="edit_email" value="" placeholder="Enter Email">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Phone</label>
                      <input type="text" class="form-control" id="edit_phone" name="edit_phone" value="" placeholder="Enter Phone">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" id="edit_password" name="edit_password" value="" placeholder="Enter Password">
                    </div>

                    <button type="button" id="update" class="btn btn-primary w-100">Save</button>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function() {

      // Load table
      function loadTable() {
        $.ajax({
          url: "ajax_load.php",
          type: "POST",
          success: function(data) {
            $("#table-data").html(data);
          }
        });
      }

      loadTable();

      // Submit Data
      $("#submit").off("click").on("click", function() {
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var password = $("#password").val();

        if (name == "" || email == "" || phone == "" || password == "") {
          $("#error-messge").html("All fields are required!").slideDown();
          $("#error-messge").slideUp();
          //   alert("Name fields are required!");
          //   return;
        } else {
          $.ajax({
            url: "ajax_insert.php",
            type: "POST",
            data: {
              name: name,
              email: email,
              phone: phone,
              password: password
            },
            success: function(data) {
              if (data == 1) {
                loadTable();
                $("#userForm")[0].reset(); // Clear form
                $("#success-messge").html("Data Insert Successfully !").slideDown();
                $("#error-messge").slideUp();
              } else {
                $("#error-messge").html("Record Faild").slideDown();
                $("#success-messge").slideUp();
              }
            }
          });
        }
      });

      // Delete Data
      $(document).on("click", ".delete-Btn", function() {
        var u_id = $(this).data("id");
        var element = this;
        // console.log(u_id);
        // alert(u_id);
        if (confirm("Kya Aap Is Record Ko Delete Karna Chahte Ho !")) {

          $.ajax({
            url: "ajax_delete.php",
            type: "POST",
            data: {
              id: u_id
            },
            success: function(data) {
              if (data == 1) {
                loadTable();
                $(element).closest("tr").fadeOut();
                $("#success-messge").html("All fields are required!").slideDown();
                $("#error-messge").slideUp();
              } else {
                $("#error-messge").html("All fields are required!").slideDown();
                $("#success-messge").slideUp();
              }
            }
          });

        }
      });

      // Fache Edite Time TO Data 
      $(document).on("click", ".edit-Btn", function() {
        var userId = $(this).data("eid");
        $.ajax({
          url: "ajax_fetch.php",
          type: "POST",
          data: {
            id: userId
          },
          success: function(data) {
            var obj = JSON.parse(data);

            $("#id").val(obj.id);
            $("#edit_name").val(obj.name);
            $("#edit_email").val(obj.email);
            $("#edit_phone").val(obj.phone);
            $("#edit_password").val(obj.password);
          }
        });
      });

      // Update Data
      $("#update").off("click").on("click", function() {
        var id = $('#id').val();
        var name = $("#edit_name").val();
        var email = $("#edit_email").val();
        var phone = $("#edit_phone").val();
        var password = $("#edit_password").val();

        if (name == "" || email == "" || phone == "" || password == "") {
          $("#error-messge").html("All fields are required!").slideDown();
          $("#success-messge").slideUp();
          //   alert("Name fields are required!");
          //   return;
        } else {
          $.ajax({
            url: "ajax_update.php",
            type: "POST",
            data: {
              id: id,
              name: name,
              email: email,
              phone: phone,
              password: password
            },
            success: function(data) {
              if (data == 1) {
                $('#exampleModal').modal('hide');
                loadTable();
                $("#userForm")[0].reset(); // Clear form
                $("#success-messge").html("Update Successfully!").slideDown().delay(2000).slideUp();
                $("#error-messge").slideUp();

              } else {
                $("#error-messge").html("Record Faild").slideDown();
                $("#success-messge").slideUp();
              }
            }
          });
        }
      });

    });
  </script>

</body>

</html>