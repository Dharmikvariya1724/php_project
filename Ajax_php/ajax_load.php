<?php
$conn = mysqli_connect("localhost","root","","php_oop") or die("Connection Failed: " . mysqli_connect_error());

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

$output = "";
$i=1;
if(mysqli_num_rows($result) > 0){
    $output = '<table class="table my-4 col-6">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr>
                        <td>'.$i++.'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-Btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-eid="'.$row['id'].'">Edit</button>
                            <button class="btn btn-danger btn-sm delete-Btn" data-id="'.$row['id'].'">Delete</button>
                        </td>
                    </tr>'; 
    }
    $output .= '</table>';
} else {
    $output = "<h4>No Record Found :(</h4>";
}

mysqli_close($conn);

echo $output;
?>