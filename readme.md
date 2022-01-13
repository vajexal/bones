This extension forbids undeclared properties access (like php 8.2), but for php 7.4+

[![Build Status](https://github.com/vajexal/php-ext-bones/workflows/Build/badge.svg)](https://github.com/vajexal/php-ext-bones/actions)

For example

```php
class Foo {}

$foo = new Foo();

echo $foo->a; // Fatal error: Undefined property Foo::$a
```

Exceptions are objects, stdClass and classes with __get/__set

```php
$obj = (object) [];

$obj->a = 123; // no error

$obj = new stdClass();

$obj->a = 123; // no error

class Foo
{
    private array $props = [];

    public function __get(string $name)
    {
        return $this->props[$name];
    }

    public function __set(string $name, $value)
    {
        $this->props[$name] = $value;
    }
}

$foo = new Foo();

$foo->a = 123; // no error

echo $foo->a, PHP_EOL; // no error
```

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
