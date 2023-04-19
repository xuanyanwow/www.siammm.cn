<?php

use think\facade\Db;
require "./common.php";

use Medoo\Medoo;

$vacabulary = !empty($_POST['vacabulary']) ? $_POST['vacabulary'] : 'power';
if (!$vacabulary){
    json(400,[],'必传');
}
 
// 根据日期排序

$list =  Db::name('vacabularys')->order('create_at','desc')->select();
 
json(200,$list);