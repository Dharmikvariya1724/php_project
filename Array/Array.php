<?php

$stds = [
    "ram" => [
        'Eng' =>  12,
        'guj' => 15,
        'maths' => 22
    ],
    "shyam" => [
        'Eng' =>  82,
        'guj' =>   45,
        'maths' =>   98
    ],
    "kam" => [
        'Eng' =>   175,
        'guj' =>   789,
        'maths'  =>  142
    ],
];

// foreach ($stds as $key => $stu) {
//     echo $key . ":" . " " . "<br>";
//     foreach ($stu as $Sname => $marks) {
//         echo $Sname . " " . $marks . "<br>";
//     }
//     echo "<br>";
// }

// list Function Use to Data Print In Single Forech Loop;
foreach ($stds as $name => list("Eng" => $eng, "guj" => $guj, "maths" => $maths)) {
    echo $name . " " . "<br>";
    echo "Eng " . $eng . "<br>", "Guj " . $guj . "<br>", "Maths " . $maths . "<br>";
    echo "<br>";
}