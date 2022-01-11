--TEST--
Undeclared property access on anonymous class
--EXTENSIONS--
bones
--FILE--
<?php
$foo = new class {};

$foo->a = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property class@anonymous::$a in %s:4
Stack trace:
#0 {main}
  thrown in %s on line 4
