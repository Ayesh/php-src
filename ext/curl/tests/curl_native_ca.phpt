--TEST--
Curl defaulting to default CA root store, especially in Windows
--EXTENSIONS--
curl
--DESCRIPTION--
On Windows, there is no fallback root CA store, so all HTTPS requests that require validation (default)
fail by default. Curl >= 7.71.0 has a CURLOPT_SSL_OPTIONS = CURLSSLOPT_NATIVE_CA option that falls back
to Windows root CA store.
--SKIPIF--
<?php

// if (getenv("SKIP_ONLINE_TESTS")) die("skip online test");

if (curl_version()['version_number'] < 0x074700) {
//    die("skip: test works only with curl >= 7.71.0");
}

?>
--FILE--
<?php
    $ch = curl_init('https://sha256.badssl.com/');
    var_dump(__LINE__);
    $cert = curl_getinfo($ch, CURLINFO_CAINFO);
    var_dump($cert);
    var_dump(__LINE__);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 1,
    ]);

    var_dump(__LINE__);
    curl_exec($ch);
    var_dump(__LINE__);
    var_dump(curl_getinfo($ch, CURLINFO_SSL_VERIFYRESULT));
    var_dump(__LINE__);
    var_dump(ini_get('curl.cainfo'));
    var_dump(__LINE__);
    var_dump(curl_version());
?>
--EXPECT--
int(0)
dsdsad
