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

$flags = STREAM_CLIENT_CONNECT;
    $ctx = stream_context_create(['ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]]);

$client = stream_socket_client("quic://php.watch", $errno, $errstr, 10, $flags, $ctx);
--EXPECTF--
resource(%d) of type (stream)
bool(false)
bool(false)
