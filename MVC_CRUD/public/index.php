<?php

// database connection
require "../config/database.php";

// controller include
require "../controllers/UserController.php";

// controller object create
$controller = new UserController($conn);

// URL parameter read
// example : index.php?action=create
$action = $_GET['action'] ?? 'index';

// router
switch ($action) {

    // create page
    case "create":
        $controller->create();
        break;

    // store data
    case "store":
        $controller->store();
        break;

    // edit form
    case "edit":
        $controller->edit();
        break;

    // update data
    case "update":
        $controller->update();
        break;

    // delete user
    case "delete":
        $controller->delete();
        break;

    // default page
    default:
        $controller->index();
}
