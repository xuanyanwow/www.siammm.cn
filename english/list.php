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

// 根据日期排序

$list =  $database->select("vacabularys", "*", [
 
],[
    "ORDER" => ["create_at" => "DESC"],
]);
json(200,$list);