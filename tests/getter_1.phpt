--TEST--
Undeclared property read on class with __get
--EXTENSIONS--
bones
--FILE--
<?php
class Foo
{
    public function __get(string $name)
    {
        return $name;
    }
}

$foo = new Foo();

echo $foo->a;
?>
--EXPECT--
a
