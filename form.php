<?php

$search = $_GET['wd'];

if ($search == "老公"){
    echo "老婆";
    die;
}

if ($search == "日期"){
    echo date("Y-m-d H:i:s");
    die;
}
