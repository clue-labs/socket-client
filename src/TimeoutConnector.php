<?php

namespace React\SocketClient;

use React\SocketClient\ConnectorInterface;
use React\EventLoop\LoopInterface;
use React\Promise\Timer;
use React\Stream\Stream;
use React\Promise\Promise;
use React\Promise\CancellablePromiseInterface;

class TimeoutConnector implements ConnectorInterface
{
    private $connector;
    private $timeout;
    private $loop;

    public function __construct(ConnectorInterface $connector, $timeout, LoopInterface $loop)
    {
        $this->connector = $connector;
        $this->timeout = $timeout;
        $this->loop = $loop;
    }

    public function connect($uri)
    {
        return Timer\timeout($this->connector->connect($uri), $this->timeout, $this->loop);
    }
}
