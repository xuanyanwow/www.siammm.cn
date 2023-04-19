<?php

require_once "./vendor/autoload.php";

use think\facade\Db;

// 允许跨域请求的域名
$allowed_origin = "http://example.com";

// 如果是跨域请求，添加响应头
// && $_SERVER["HTTP_ORIGIN"] == $allowed_origin
if (isset($_SERVER["HTTP_ORIGIN"]) ) {
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
}

// 处理请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ...处理 POST 请求...
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // ...处理 GET 请求...
} else if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    // 如果是 OPTIONS 请求，只需要响应 header 头即可
    exit;
}

// 数据库配置信息设置（全局有效）
Db::setConfig([
    // 默认数据连接标识
    'default'     => 'mysql',
    // 数据库连接信息
    'connections' => [
        'mysql' => [
            // 数据库类型
            'type'     => 'mysql',
            // 主机地址
            'hostname' => '127.0.0.1',
            // 用户名
            'username' => 'english',
            // 数据库名
            'database' => 'english',
            'password'=>'tNbmktnxZsnkGJxa',
            // 数据库编码默认采用utf8
            'charset'  => 'utf8',
            // 数据库表前缀
            'prefix'   => '',
            // 数据库调试模式
            'debug'    => true,
        ],
    ],
]);


function json($code =200,$data=[],$msg = ''){
    echo json_encode([
        'code' => $code,
        'data' => $data,
        'msg' => $msg
        ]);
}