--TEST--
Undeclared property write on object
--EXTENSIONS--
bones
--FILE--
<?php
$obj = (object)[];
$obj->a = 123;
echo $obj->a;
?>
--EXPECT--
123
