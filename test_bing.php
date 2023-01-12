<?php
header("Access-Control-Allow-Origin: *");

$url=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1&format=js');
echo $url;die;