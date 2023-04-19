<?php

use think\facade\Db;

require "./common.php";


$vacabulary = !empty($_POST['vacabulary']) ? $_POST['vacabulary'] : 'power';
if (!$vacabulary){
    json(400,[],'必传');
}
 
$datas = Db::name('vacabularys')->where('vacabulary_content', $vacabulary)->find();

// 关联出主词根

// 带出衍生词


json(200,$datas,'必传');