<?php 

require_once "connfig/database.php";

session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit;
?>