--TEST--
Undeclared property write on class in namespace
--EXTENSIONS--
bones
--FILE--
<?php
namespace X {
    class Foo {}
}

namespace {
    $foo = new X\Foo();

    $foo->a = 123;
}
?>
--EXPECTF--
Fatal error: Uncaught Error: Undefined property X\Foo::$a in %s:9
Stack trace:
#0 {main}
  thrown in %s on line 9
