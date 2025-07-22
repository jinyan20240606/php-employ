<?php

class A{
    public function get_name()
    {
        return 'A-get_name';
    }
}

class B{
    public function get_name(A $a)
    {
        $name = $a->get_name();
        return $name;
    }
}

$b = new B();
$obj = new A();
echo $b->get_name($obj);
