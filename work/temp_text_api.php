<?php
$mode = $_POST['mode'];

if ($mode == "get"){
    echo file_get_contents("temp_text.txt");
    die;
}else{
    $temp_text = $_POST['temp_text'];
    file_put_contents("temp_text.txt", $temp_text);
}