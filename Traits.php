<?php

trait hello
{
    public function sayHello()
    {
        echo "Hello brother ";
    }
}

trait bye
{
    public function sayHii()
    {
        echo " Hii brother ";
    }
    public function sayBye()
    {
        echo " Bye brother ";
    }
}

class base
{
    use hello, bye;
}

class base1
{
    use hello;
}

class base2
{
    use hello;
}

$test = new base();
$test1 = new base1();
$test2 = new base2();

$test->sayHello();
$test->sayHii();
$test->sayBye();
$test1->sayHello();
$test2->sayHello();
