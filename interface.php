<?php

interface parent1
{
    function asd($n, $m);
}

interface parent2
{
    function min($a, $b);
}

class chaildClass implements parent1, parent2
{
    public function asd($n, $m)
    {
        echo "Sub " . $n + $m."<br>";
    }

    public function min($a, $b)
    {
        echo "min " . $a - $b;
    }
}
$test = new chaildClass;
$test->asd(10, 20);
$test->min(50, 15);
