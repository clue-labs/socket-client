<?php

$host = 'self-signed.badssl.com';
$ip = gethostbyname($host);
$f = stream_socket_client('tcp://' . $ip . ':443', $errstr, $errno, 0, STREAM_CLIENT_CONNECT|STREAM_CLIENT_ASYNC_CONNECT);
stream_set_blocking($f, 0);

// wait for connection to succeed
$n = null; $w = array($f);
stream_select($n, $w, $n, null);

stream_context_set_option($f, 'ssl', 'SNI_enabled', true);
stream_context_set_option($f, 'ssl', 'CN_match', $host);
stream_context_set_option($f, 'ssl', 'SNI_server_name', $host);
stream_context_set_option($f, 'ssl', 'verify_peer', true);

while (true) {
    // try to enable crypto
    $o = stream_socket_enable_crypto($f, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

    // 0=keep trying, otherwise success/error
    if ($o !== 0) {
        break;
    }

    // try again once we receive data
    $r = array($f);
    stream_select($r, $n, $n, null);
}

