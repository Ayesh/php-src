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
if (getenv("SKIP_ONLINE_TESTS")) die("skip online test");
$curl_version = curl_version();
if ($curl_version['version_number'] < 0x074700) {
    die("skip: test works only with curl >= 7.71.0");
}
?>
--INI--

--FILE--
<?php
    $ch = curl_init('https://sha256.badssl.com/');
    $cert = curl_getinfo($ch, CURLINFO_CAINFO);
    var_dump($cert);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => 1,
    ]);

    curl_exec($ch);
    var_dump(curl_getinfo($ch, CURLINFO_SSL_VERIFYRESULT));

?>
--EXPECT--
int(0)
