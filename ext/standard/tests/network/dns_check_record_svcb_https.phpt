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

$dns = dns_get_record('test1.http3.info', DNS_HTTPS);

if (empty($dns[0])) {
    echo "DNS_SVCB Lookup failed\n";
    die();
}

echo "HTTPS record found";

var_dump(array_key_exists('type', $dns[0]));
var_dump($dns[0]['type']);
var_dump(is_int($dns[0]['SvcPriority']));
var_dump(is_string($dns[0]['TargetName']) && !empty($dns[0]['TargetName']));
var_dump(is_string($dns[0]['SvcParams']) && !empty($dns[0]['SvcParams']));
var_dump($dns);
?>
--EXPECT--
int(131072)
int(262144)
HTTPS record found
