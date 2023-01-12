<?php


function http_post_json($url, $jsonStr = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    if(!empty($jsonStr)){
        
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response);
}


$url = "https://www.eeagd.edu.cn/zkselfec/login/checkYbmhSj.jsmeb"; //请求地址
$arr = [['lx'=>"0"]]; //请求参数(数组)
$jsonStr = json_encode($arr,256); //转换为json格式
$result = http_post_json($url, $jsonStr);
$data = $result[1];
$data = json_decode($data, true);
if ($data['result']['code'] == '-200'){
    $text = '【自考提醒】还不可以报名o(╥﹏╥)o';
}else{
    $text = '【自考提醒】可以报名啦';
}

$da = http_post_json("https://api2.pushdeer.com/message/push?pushkey=PDU11152TWkWRKFT0d9V5peVRdDjqER7GyhSfFZA0&text=".$text);
var_dump($da);