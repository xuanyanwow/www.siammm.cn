<?php

require "./common.php";
require "./model/Vacabularys.php";

use Medoo\Medoo;

$vacabulary = !empty($_POST['vacabulary']) ? $_POST['vacabulary'] : 'power';
if (!$vacabulary){
    json(400,[],'必传');
}
 
// 根据日期排序
$list =  Vacabularys::order('create_at','desc')->select()->each(function($item){
    // create_at格式化
    $item->create_at = date('Y-m-d',$item->create_at);
});
// 根据create_at 日期分组
function array_group ($arr, $key) {
    $grouped = [];
    foreach ($arr as $value) {
        $grouped[$value->$key][] = $value;
    }
    // krsort($grouped);
    return $grouped;
}
$list = array_group($list,'create_at');



 
json(200,$list);