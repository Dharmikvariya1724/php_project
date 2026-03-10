<?php

// User model class
// model નું કામ database query run કરવાનું હોય છે

class User
{

    // private variable database connection store કરવા માટે
    private $conn;

    // constructor object create થાય ત્યારે run થાય
    public function __construct($conn)
    {

        // database connection class variable માં store થાય
        $this->conn = $conn;
    }

    // READ → બધા users fetch કરવા માટે
    public function getAllUsers()
    {

        // SQL query
        $sql = "SELECT * FROM users";

        // query database માં run થાય
        return mysqli_query($this->conn, $sql);

        // result controller ને return થાય
    }

    // CREATE → new user add
    public function createUser($data)
    {

        // form માંથી name
        $name = $data['name'];

        // form માંથી email
        $email = $data['email'];

        // password hashing security માટે
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        // insert query
        $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";

        // query execute
        mysqli_query($this->conn, $sql);
    }

    // single user fetch
    public function getUser($id)
    {

        // specific user fetch
        $sql = "SELECT * FROM users WHERE id=$id";

        return mysqli_query($this->conn, $sql);
    }

    // UPDATE user
    public function updateUser($id, $data)
    {

        // updated name
        $name = $data['name'];

        // updated email
        $email = $data['email'];

        // update query
        $sql = "UPDATE users 
        SET name='$name', email='$email' WHERE id=$id";

        mysqli_query($this->conn, $sql);
    }

    // DELETE user
    public function deleteUser($id)
    {

        // delete query
        $sql = "DELETE FROM users WHERE id=$id";

        mysqli_query($this->conn, $sql);
    }
}
