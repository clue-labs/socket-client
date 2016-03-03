<?php

$f = stream_socket_client('tcp://self-signed.badssl.com:443', $errstr, $errno, 10, STREAM_CLIENT_CONNECT);
stream_context_set_option($f, 'ssl', 'verify_peer', true);
stream_socket_enable_crypto($f, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
