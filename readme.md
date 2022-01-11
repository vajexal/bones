This extension forbids undeclared properties access (like php 8.2), but for php 7.4+. For example

```php
class Foo {}

$foo = new Foo();

echo $foo->a; // Fatal error: Undefined property Foo::$a
```

Exceptions are objects, stdClass and classes with __get/__set

### Installation

```bash
phpize
./configure
make
make install
```

### Testing

```bash
make test
```
