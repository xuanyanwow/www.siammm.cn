<?php
function trim_array($input) {
  if (!is_array($input))
    return trim($input);
  return array_map('trim_array', $input);
}


$origin = $_POST['origin'];
$print  = $_POST['print'];



$originArray = explode("\n", $origin);
$printArray  = explode("\n", $print);

$originArray = trim_array($originArray);
$printArray  = trim_array($printArray);

// var_dump($printArray);
// var_dump($originArray);


// PDD多出的：

echo "录单多出<br/>";
foreach ($originArray as $originItem){
    if (!in_array($originItem, $printArray)){
        echo $originItem. "<br/>";
    }
}

echo "<br/><br/><br/>打印多出<br/>";
foreach ($printArray as $printItem){
    if (!in_array($printItem, $originArray)){
        echo $printItem. "<br/>";
    }
}