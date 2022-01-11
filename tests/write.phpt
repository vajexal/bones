--TEST--
Undeclared property write on class
--EXTENSIONS--
bones
--FILE--
<?php
class Foo {}

$foo = new Foo();

$foo->a = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:6
Stack trace:
#0 {main}
  thrown in %s on line 6
