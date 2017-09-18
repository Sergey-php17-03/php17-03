<?php

// array_assoc_mixing - key => value is tied V2_0

$listAssoc = array(
    "1" => 'one',
    "2" => 'two',
    "3" => 'three',
    "4" => 'four',
    'A' => '[ei]',
    'B' => '[bi:]',
    'C' => '[si:]',
    'D' => '[di:]',
    'F' => '[ef]'
);

for ($i = 10; $i < 1000000; $i++){
    $listAssoc[$i] = $i;    
}

$count = count($listAssoc);
$assocKeys = array_keys($listAssoc);
$assocValue = array_values($listAssoc);

for ($i = 0; $i < $count / 2; $i++) {
    $key = rand(0, $count-1);
    
    $tmpKeys = $assocKeys[$i];
    $assocKeys[$i] = $assocKeys[$key];
    $assocKeys[$key] = $tmpKeys;
    
    $tmpValue = $assocValue[$i];
    $assocValue[$i] = $assocValue[$key];
    $assocValue[$key] = $tmpValue;   
    
}

for ($i = 0; $i < $count; $i++){
$listAssocNew[$assocKeys[$i]] = $assocValue[$i]; 
}

echo '<pre>';
print_r($listAssocNew);
echo '</pre>';

