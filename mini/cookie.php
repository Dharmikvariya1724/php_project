<?php

$cokkie_name = "user";
$cookie_value = "dharmik";

setcookie($cokkie_name, $cookie_value, time() + (3600 * 24), "/");

// echo $_COOKIE[$cokkie_name];

if (isset($_COOKIE[$cokkie_name])) {
    echo $_COOKIE[$cokkie_name];
} else {
    echo "Cookie Is Not Set";
}