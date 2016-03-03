<?php

stream_context_set_default(array('ssl'=>array('verify_peer'=>true)));
stream_socket_client('tls://self-signed.badssl.com:443', $errstr, $errno, 10, STREAM_CLIENT_CONNECT);
