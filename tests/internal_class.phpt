--TEST--
Undeclared property write on internal class
--EXTENSIONS--
bones
--FILE--
<?php
$stack = new SplStack();

$stack->a = 123;
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property SplStack::$a in %s:4
Stack trace:
#0 {main}
  thrown in %s on line 4
