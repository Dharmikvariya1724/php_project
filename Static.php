<?php

class base
{
    public $name = "Dharmik";
    public static $user = "Hello";

    public function show()
    {
        // echo $this->name;
        echo self::$user;
    }
}

// $test = new base();
// $test->show();

echo base::$user;
