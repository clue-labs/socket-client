<?php

$host = 'self-signed.badssl.com';
$ip = gethostbyname($host);
$f = stream_socket_client('tcp://' . $ip . ':443', $errstr, $errno, 10);

stream_context_set_option($f, 'ssl', 'CN_match', $host);
stream_context_set_option($f, 'ssl', 'verify_peer', true);

stream_socket_enable_crypto($f, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
