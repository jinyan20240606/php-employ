<?php
trait A{
    public function getName()
    {
        return 'This is trait';
    }
}

class B{
    use A;
}
$b = new B();
echo $b->getName(); //This is trait