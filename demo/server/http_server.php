<?php
use Swoole\Http\Server;

$http = new Server("0.0.0.0", 8801);
$http->set(
    [
        'enable_static_handle' => true,
        'document_root' => __DIR__ . "/../../html"
    ]
);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start();
