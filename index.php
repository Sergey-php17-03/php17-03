<?php
// array_mixing

$list = array(1, 2, 3, 4, 5, 'A', 'B', 'C', 'D', 'F');

$count = count($list);

for ($i = 0; $i < $count/2; $i++) {
    $tmp = $list[$i];
    $key = rand(0, $count-1);
            
    $list[$i] = $list[$key];
    $list[$key] = $tmp;
}
echo '<pre>';
print_r($list);
echo '</pre>';


// array_assoc_mixing

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

$count2 = count($listAssoc);

for ($i = 0; $i < $count2 / 2; $i++) {
    $assocKeys = array_keys($listAssoc);
    $tmp = $listAssoc[$assocKeys[$i]];
    $key = rand(0, $count2 - 1);

    $listAssoc[$assocKeys[$i]] = $listAssoc[$assocKeys[$key]];
    $listAssoc[$assocKeys[$key]] = $tmp;
}

echo '<pre>';
print_r($listAssoc);
echo '</pre>';


// array_assoc_mixing -key => value is tied

$listAssoc2 = array(
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

$count3 = count($listAssoc2);

for ($i = 0; $i < $count3 / 2; $i++) {
    $assocKeys = array_keys($listAssoc2);
    $key2 = rand(0, $count3 - 1);
    $tmp = $listAssoc2[$assocKeys[$key2]];

    unset($listAssoc2[$assocKeys[$key2]]);
    $listAssoc2[$assocKeys[$key2]] = $tmp;
}

echo '<pre>';
print_r($listAssoc2);
echo '</pre>';


