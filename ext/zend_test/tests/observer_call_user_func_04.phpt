--TEST--
Observer: call_user_func_array() from namespace
--EXTENSIONS--
zend_test
--INI--
zend_test.observer.enabled=1
zend_test.observer.show_output=1
zend_test.observer.observe_all=1
--FILE--
<?php
namespace Test {
    final class MyClass
    {
        public static function myMethod(string $msg)
        {
            echo 'MyClass::myMethod ' . $msg . PHP_EOL;
        }
    }

    function my_function(string $msg)
    {
        echo 'my_function ' . $msg . PHP_EOL;
    }

    call_user_func_array('Test\\MyClass::myMethod', ['called']);
    call_user_func_array('Test\\my_function', ['called']);
}
?>
--EXPECTF--
<!-- init '%s' -->
<file '%s'>
  <!-- init call_user_func_array() -->
  <call_user_func_array>
    <!-- init Test\MyClass::myMethod() -->
    <Test\MyClass::myMethod>
MyClass::myMethod called
    </Test\MyClass::myMethod>
  </call_user_func_array>
  <call_user_func_array>
    <!-- init Test\my_function() -->
    <Test\my_function>
my_function called
    </Test\my_function>
  </call_user_func_array>
</file '%s'>
