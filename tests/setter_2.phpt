--TEST--
Undeclared property read on class with __set
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

echo $foo->a;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:12
Stack trace:
#0 {main}
  thrown in %s on line 12
