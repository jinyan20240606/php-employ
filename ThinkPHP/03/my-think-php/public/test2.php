<?php
trait A{
    public function getName()
    {
        return 'A-getName';
    }

    public function getAge()
    {
        return 'A-getAge';
    }
}

class C{
    public function getName()
    {
        return 'C-getName';
    }

    public function getAge()
    {
        return 'C-getAge';
    }

    public function getSex()
    {
        return 'C-getSex';
    }
}

class B extends C{

    //使用trait
    use A;

    public function getAge()
    {
        return 'B-getAge';
    }

    public function getSex()

    {
        return 'B-getSex';
    }
}
$b = new B();
echo $b->getSex();//B-getSex
echo $b->getName();//A-getName
echo $b->getAge();//B-getAge