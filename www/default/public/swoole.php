<?php

$http = new Swoole\Http\Server('0.0.0.0', 7000);

$http->on('start', function ($server) {
    echo "Swoole http server is started\n";
});

$http->on('request', function ($request, $response) {
    $response->end('PHP Version: ' . phpversion() . '<br> Swoole Version: ' . swoole_version());
});

$http->start();