<?php

$conn = mysqli_connect("localhost","root","","php_oop") or die ("Connection Failed : " . mysqli_connect_error());
$sql = "SELECT * FROM  users";
$result = mysqli_query($conn, $sql) or  die ("Query Failed :" . mysqli_error($conn));

// echo $result;

// $row = mysqli_fetch_assoc($result); // Single Data fatch in Data base using 1D Array

// echo "<pre>";
// print_r ($row);
// echo "</pre>";

// echo $row['name'] . "<br>" . $row['email']. "<br>" . $row['password'];

echo "<table border='2'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>phone</th>";
    echo "<th>Password</th>";
    // echo "<th>salary</th>"; 
    echo "</tr>";

// while($row = mysqli_fetch_assoc($result)){
//     echo "<tr>";
//     echo "<td>".$row['name']."</td>";
//     echo "<td>".$row['email']."</td>";
//     echo "<td>".$row['phone']."</td>";
//     echo "<td>".$row['password']."</td>";
//     echo "</tr>";
// }

// $row = mysqli_fetch_all($result,MYSQLI_ASSOC); // Multipale Data fatch in Data base using mysqli_fetch_array() To Index 

// echo "<pre>";
// print_r ($row);
// echo "</pre>";
// $i=1;
// foreach($row as $data){
//     echo "<tr>";
//     echo "<td>".$i++ ."</td>";
//     echo "<td>".$data['name']."</td>";
//     echo "<td>".$data['email']."</td>";
//     echo "<td>".$data['phone']."</td>";
//     echo "<td>".$data['password']."</td>";
//     echo "</tr>";
// }

// $row = mysqli_fetch_all($result); // Multipale Data fatch in Database Using mysqli_fetch_all()

// echo "<pre>";
// print_r ($row);
// echo "</pre>";

// while($row = mysqli_fetch_array($result)){
//     echo "<tr>";
//     echo "<td>".$row['name']."</td>";
//     echo "<td>".$row['email']."</td>";
//     echo "<td>".$row['phone']."</td>";
//     echo "<td>".$row['password']."</td>";
//     echo "</tr>";
// }

$row = mysqli_fetch_all($result,MYSQLI_ASSOC); // Multipale Data fatch in Data base using usort()

// usort($row, function($a, $b){
//     return $b['id'] <=> $a['id'];
// });

echo "<pre>";
print_r ($row);
echo "</pre>";

if(count($row) > 0){
    $i=1;
    foreach($row as $data){
        echo "<tr>";
        echo "<td>".$i++ ."</td>";
        echo "<td>".$data['name']."</td>";
        echo "<td>".$data['email']."</td>";
        echo "<td>".$data['phone']."</td>";
        echo "<td>".$data['password']."</td>";
        // echo "<td>".$data['salary']."</td>";
        echo "</tr>";
    }
}else{
    echo "<tr><td colspan='5'>No Record Found!</td></tr>";
}

echo "</table>";

?>