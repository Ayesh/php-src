--TEST--
quic:// stream wrapper
--EXTENSIONS--
openssl
--SKIPIF--
<?php
if (OPENSSL_VERSION_NUMBER < 0x30200000) die("skip QUIC tests require OpenSSL 3.2");
?>
--FILE--
<?php

$ctx = stream_context_create([
'ssl' => [
    'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT
  ],
]);
//$html = file_get_contents('https://github.com', false, $ctx);
$html = file_get_contents('https://http2.pro/api/v1', context: $ctx);
var_dump($html);

--EXPECTF--
resource(%d) of type (stream)
bool(false)
bool(false)
