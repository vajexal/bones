--TEST--
Undeclared property write on indirect var
--EXTENSIONS--
bones
--FILE--
<?php
class Foo {}

$foo = new Foo();

$name = 'foo';

$$name->a = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:8
Stack trace:
#0 {main}
  thrown in %s on line 8
