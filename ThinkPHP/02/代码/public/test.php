<?php

class A{
    public function get_name()
    {
        return 'A-get_name';
    }
}

class B{
    public function get_name()
    {
        $a = new A();
        $name = $a->get_name();
        return $name;
    }
}

$b = new B();
echo $b->get_name();
