--TEST--
dns_check_record() CAA and SVCB records
--SKIPIF--
<?php
if (getenv('SKIP_ONLINE_TESTS')) die('skip online test');
?>
--FILE--
<?php

var_dump(DNS_SVCB);
var_dump(DNS_HTTPS);

$dns = dns_get_record('php.watch', DNS_HTTPS);
var_dump($dns);
if (count($dns) > 0) {
    if (array_key_exists('type', $dns[0])
    and $dns[0]['type'] == 'CAA'
    and array_key_exists('flags', $dns[0])
    and array_key_exists('tag', $dns[0])
    and array_key_exists('value', $dns[0])
    ) {
        echo "DNS_SVCB record found\n";
    }
}
else {
    echo "DNS_SVCB Lookup failed\n";
}
?>
--EXPECT--
int(131072)
int(262144)
CAA record found
