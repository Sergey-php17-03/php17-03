<?php

// array_assoc_mixing -key => value is tied

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

for ($i = 0; $i < $count / 2; $i++) {
    $key = rand(0, $count - 1);
    $tmp = $listAssoc[$assocKeys[$key]];

    unset($listAssoc[$assocKeys[$key]]);
    $listAssoc[$assocKeys[$key]] = $tmp;
}

echo '<pre>';
print_r($listAssoc);
echo '</pre>';
?>