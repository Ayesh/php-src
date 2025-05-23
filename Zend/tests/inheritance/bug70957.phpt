--TEST--
Bug #70957 (self::class cannot be resolved with reflection for abstract class)
--FILE--
<?php

abstract class Foo
{
    function bar($a = self::class) {}
}

trait T {
    public function bar() {
    }
}

class B extends Foo
{
    use T;
}
?>
--EXPECTF--
Fatal error: Declaration of B::bar() must be compatible with Foo::bar($a = 'Foo') in %s on line %d
