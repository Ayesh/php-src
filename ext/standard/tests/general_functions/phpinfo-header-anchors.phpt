--TEST--
phpinfo() with clickable anchor tags
--DESCRIPTION--
This tests for the HTML anchor tags presence in phpinfo() outputs.
The --POST-- section is used to force using CGI SAPI instead of the
default CLI SAPI.
--POST--
a=b
--FILE--
<?php
phpinfo();
?>
--EXPECTF--
%a
<h2><a name="module_core" href="#module_core">Core</a></h2>
%a
