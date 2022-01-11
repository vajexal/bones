--TEST--
Undeclared property read with $this
--EXTENSIONS--
bones
--FILE--
<?php
class Foo
{
    public function bar()
    {
        echo $this->a;
    }
}

$foo = new Foo();

$foo->bar();
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:6
Stack trace:
#0 %s(12): Foo->bar()
#1 {main}
  thrown in %s on line 6
