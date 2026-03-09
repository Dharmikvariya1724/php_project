<?php

$to = "dharmikvariya273@gmail.com";
$subject = "Test Mail";
$message = "Hello Dharmik Variya";
$form = "dharmikv1724@gmail.com";
$headers = "From : $form";

mail ($to, $subject, $message, $headers);

echo "Mail Send Sucsess Fully";

?>