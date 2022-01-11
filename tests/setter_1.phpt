--TEST--
Undeclared property write on class with __set
--EXTENSIONS--
bones
--FILE--
<?php
class Foo
{
    public function __set(string $name, $value)
    {
        echo "{$name} {$value}\n";
    }
}

$foo = new Foo();

$foo->a = 123;
?>
--EXPECT--
a 123
