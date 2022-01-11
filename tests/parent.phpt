--TEST--
Undeclared property read from parent class
--EXTENSIONS--
bones
--FILE--
<?php
class Foo
{
    public int $a = 123;
}

class Bar extends Foo {}

$bar = new Bar();

echo $bar->a;
?>
--EXPECT--
123
