<?php

// mysqli_connect() database સાથે connection બનાવવા માટે use થાય છે
// parameters : (server, username, password, database)

$conn = mysqli_connect("localhost", "root", "", "test");

// જો connection fail થાય તો program stop કરી દે
if (!$conn) {
    die("Database connection failed");
}
