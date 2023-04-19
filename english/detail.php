<?php

require "./Medoo.php";
require "./common.php";

use Medoo\Medoo;

$vacabulary = !empty($_POST['vacabulary']) ? $_POST['vacabulary'] : 'power';
if (!$vacabulary){
    json(400,[],'必传');
}
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'english',
	'server' => 'localhost',
	'username' => 'english',
	'password' => 'tNbmktnxZsnkGJxa',
 
	// [optional]
	'charset' => 'utf8mb4',
	'port' => 3306,
]);

$datas = $database->get("vacabularys", "*", [
    "vacabulary_content" => $vacabulary
]);

// 关联出主词根

// 带出衍生词


    json(200,$datas,'必传');