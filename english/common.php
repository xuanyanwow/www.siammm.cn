<?php

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


function json($code =200,$data=[],$msg = ''){
    echo json_encode([
        'code' => $code,
        'data' => $data,
        'msg' => $msg
        ]);
}