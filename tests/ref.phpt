--TEST--
Undeclared property write on reference
--EXTENSIONS--
bones
--FILE--
<?php
class Foo {}

$foo    = new Foo();
$fooRef = &$foo;

echo $fooRef->a;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property Foo::$a in %s:7
Stack trace:
#0 {main}
  thrown in %s on line 7
