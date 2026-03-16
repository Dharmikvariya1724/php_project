<?php

require_once 'db.php';

$db= new Database();

if(isset($_POST['action']) && $_POST['action'] == "view"){
    $output = '';
    $data = $db->read();
    // print_r($data);

    if($db->totalRowCount()>0){
        $output .= '<table class="table table-hover align-middle modern-table">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col" class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach($data as $row ){
            $output .= '
            <tr>
                <th scope="row">'.$row['id'].'</th>
                <td scope="row">'.$row['fname'].'</td>
                <td scope="row">'.$row['lname'].'</td>
                <td scope="row">'.$row['email'].'</td>
                <td scope="row">'.$row['phone']. '</td>
                <td scope="row" class="text-end">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                        <a href="#" class="btn btn-success editBtn" data-bs-toggle="modal" data-bs-target="#exampleEditModal" id="'.$row['id'].'" >Edit</a>
                        <a href="#" class="btn btn-danger deleteBtn" id="'.$row['id'].'" >Delete</a>
                    </div>
                </td>
            </tr>';
        }
        $output.= '</tbody></table>';
    } else {
        $output = "<h3 class='text-center text-danger'>No Record Found</h3>";
    }
    echo $output;
}

if(isset($_POST['action']) && $_POST['action'] == "insert"){
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $email= $_POST['email'];
    $phone = $_POST['phone'];

    $db->insert($fname, $lname, $email, $phone);
}

if (isset($_POST['edit_id']) ){
    $id = $_POST['edit_id'];
    $row = $db->getUserbyId($id);
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == "update") {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $db->update($id,$fname, $lname, $email, $phone);
}

if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $db->delete($id);
}

?>
