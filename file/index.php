<?php

if (isset($_FILES['image'])) {
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    $file_name = $_FILES['image']['name'];
    $file_full_path = $_FILES['image']['full_path'];
    $file_type = $_FILES['image']['type'];
    $file_tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($file_tmp_name, "uploads/" . $file_name)) {
        echo "File Upload Success Fully";
    } else {
        echo "File Not Uploaded";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" multiple /><br><br>
        <input type="submit">
    </form>
</body>

</html>