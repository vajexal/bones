--TEST--
Undeclared property read on stdClass
--EXTENSIONS--
bones
--FILE--
<?php
$obj = new stdClass();
$obj->a = 123;
echo $obj->a;
?>
--EXPECT--
123
