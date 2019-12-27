<?php
//创建Server对象，监听 127.0.0.1:9501端口
$serv = new Swoole\Server("127.0.0.1", 9501);
$serv->set(array(
    'worker_num' => 4,    //worker process num
    'max_request' => 10000,
));
//监听连接进入事件
$serv->on('Connect', function ($serv, $fd, $reactor_id) {
    echo "Client:{$fd}-{$reactor_id} Connect.\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: {$fd}-{$reactor_id}".$data);
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client:{$fd} Close.\n";
});

//启动服务器
$serv->start();