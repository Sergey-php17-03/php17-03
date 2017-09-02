<?php
// array_mixing

$list = array(1, 2, 3, 4, 5, 'A', 'B', 'C', 'D', 'F',);

$count = count($list);

for ($i = 0; $i < $count/2; $i++) {
    $key = rand(0, $count-1);
    $tmp = $list[$key];
    $key2 = $count - $key - 1;
    
    $list[$key] = $list[$key2];
    $list[$key2] = $tmp;
}
echo '<pre>';
print_r($list);
echo '</pre>';




