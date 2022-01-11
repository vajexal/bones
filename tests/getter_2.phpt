--TEST--
Undeclared property write on class with __get
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

$foo->a = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:12
Stack trace:
#0 {main}
  thrown in %s on line 12
