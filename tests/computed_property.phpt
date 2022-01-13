--TEST--
Undeclared property write with computed property
--EXTENSIONS--
bones
--FILE--
<?php
class Foo {}

$foo = new Foo();

$name = 'a';

$foo->$name = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:8
Stack trace:
#0 {main}
  thrown in %s on line 8
