<?php

if (empty($_GET['file'])){
    die("file");
}


if (empty($_GET['text'])){
    die("text");
}

$file = $_GET['file'];
$text = $_GET['text'];



$file_path = __DIR__ . DIRECTORY_SEPARATOR . "note" . DIRECTORY_SEPARATOR . $file;

$file_content = "\n{$text}";

file_put_contents($file_path, $file_content, FILE_APPEND);

echo "success";