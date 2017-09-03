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




