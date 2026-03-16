<?php

class Database {

private $dsn = "mysql:host=localhost; dbname=php_oop_crud";
private $user = "root";
private $pass = "";
public $conn;

    public function __construct()
    {
        try{
            $this->conn = new PDO($this->dsn,$this->user,$this->pass);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function insert($fname, $lname, $email, $phone, $password){
        $sql = "INSERT INTO users (fname, lname, email, phone, password) VALUES (:fname,:lname,:email,:phone, :password);";
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            'fname'=> $fname,
            'lname'=> $lname,
            'email'=> $email,
            'phone' => $phone,
            'password' => $hashPassword
            ]);

        return true;
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($user);
        // exit;
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
$ob = new Database();
?>