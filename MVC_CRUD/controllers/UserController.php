<?php

// model include
require "../models/User.php";

class UserController
{

    // model variable
    private $model;

    // constructor
    public function __construct($conn)
    {

        // User model object create
        $this->model = new User($conn);
    }

    // user list show
    public function index()
    {

        // model function call
        $users = $this->model->getAllUsers();

        // view load
        include "../views/users/index.php";
    }

    // create form show
    public function create()
    {

        // registration form open
        include "../views/users/create.php";
    }

    // form submit
    public function store()
    {

        // form data model માં pass
        $this->model->createUser($_POST);

        // redirect
        header("Location: index.php");
    }

    // edit form
    public function edit()
    {

        // URL માંથી id
        $id = $_GET['id'];

        // user data fetch
        $user = $this->model->getUser($id);

        // edit view load
        include "../views/users/edit.php";
    }

    // update user
    public function update()
    {

        // URL id
        $id = $_GET['id'];

        // update query
        $this->model->updateUser($id, $_POST);

        // redirect
        header("Location: index.php");
    }

    // delete user
    public function delete()
    {

        // URL id
        $id = $_GET['id'];

        // delete function
        $this->model->deleteUser($id);

        header("Location: index.php");
    }
}
