<?php


require "./common.php";
require "./model/Vacabularys.php";


$vacabulary = !empty($_REQUEST['vacabulary']) ? $_REQUEST['vacabulary'] : 'power';
if (!$vacabulary){
    json(400,[],'必传');
}
 
$datas = Vacabularys::where('vacabulary_content', $vacabulary)->with(['root'])->find();

if ($datas){
    $datas->sub = $datas->sub;
$datas->more = $datas->more;
}
// 关联出主词根

// 带出衍生词


json(200,$datas,'必传');