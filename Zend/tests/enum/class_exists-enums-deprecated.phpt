--TEST--
Calling class_exists() on Enums should trigger a deprecation
--DESCRIPTION--
Calling class_exists() on Enums is deprecated, but it should continue to return
the correct result. The underlying functionality for (class|trait|enum|interface)_exists
is shared, so this deprecation should only affect class_exists() function and no
other functions.
--FILE--
<?php

enum Foo {
    case Bar;
}

class Bar {

}

spl_autoload_register(function ($className) {
    echo "Triggered autoloader with Enum $className\n";

    if ($className === 'Quux') {
        enum Quux {}
    }
});

echo "Testing: Foo";
var_dump(class_exists('Foo'));
var_dump(enum_exists('Foo'));

echo "Testing: Bar\n";
var_dump(class_exists('Bar'));
var_dump(!enum_exists('Bar'));
var_dump(!enum_exists('Bar', true));

echo "Testing: Quux\n";
var_dump(!class_exists('Quux', false));
var_dump(class_exists('Quux', true));
var_dump(class_exists('Quux', true));
var_dump(enum_exists('Quux', true));

echo "trait_exists() and interface_exists()\n";
var_dump(!trait_exists('Foo'));
var_dump(!trait_exists('Bar'));
var_dump(!trait_exists('Quux'));
var_dump(!interface_exists('Foo'));
var_dump(!interface_exists('Bar'));
var_dump(!interface_exists('Quux'));
?>
--EXPECTF--
Testing: Foo
Deprecated: using class_exists() for enums is deprecated, triggerred for calling class_exists() for enum "Foo". Use enum_exists() instead %s on line %d
bool(true)
bool(true)
Testing: Bar
bool(true)
bool(true)
bool(true)
Testing: Quux
bool(true)
Triggered autoloader with Enum Quux

Deprecated: using class_exists() for enums is deprecated, triggerred for calling class_exists() for enum "Quux". Use enum_exists() instead %s on line %d
bool(true)

Deprecated: using class_exists() for enums is deprecated, triggerred for calling class_exists() for enum "Quux". Use enum_exists() instead %s on line %d
bool(true)
bool(true)
trait_exists() and interface_exists()
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
