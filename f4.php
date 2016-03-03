<?php

$f = stream_socket_client('tcp://self-signed.badssl.com:443', $errstr, $errno, 0, STREAM_CLIENT_CONNECT|STREAM_CLIENT_ASYNC_CONNECT);
stream_set_blocking($f, 0);

$n = null; $w = array($f);
stream_select($n, $w, $n, 10);

stream_context_set_option($f, 'ssl', 'verify_peer', true);

while (true) {
    $r = stream_socket_enable_crypto($f, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    if ($r !== 0) {
        break;
    }
    usleep(100000);
}

