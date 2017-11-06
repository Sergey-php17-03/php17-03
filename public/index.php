<?php

session_start();
//ini_set('display_errors', 'on');

// array_mixing

$list = array(1, 2, 3, 4, 5, 'A', 'B', 'C', 'D', 'F');

$count = count($list);

for ($i = 0; $i < $count / 2; $i++) {
    $tmp = $list[$i];
    $key = rand(0, $count - 1);

    $list[$i] = $list[$key];
    $list[$key] = $tmp;
}

echo 'PHP1703_8(Sergey)<br><br>
    
<form action="/" method="POST">
    <button name="page" value="pdo">PDO</button>
    <button name="page" value="test">OOП</button>
    <button name="page" value="regular">ДЗ Регулярные выражения</button>
    <button name="page" value="table">Дз таблица</button>
</form>';


if (!empty($_POST['page'])) {
    $_SESSION['page'] = $_POST['page'];
}

if (!empty($_SESSION['page'])) {
    include __DIR__."/../{$_SESSION['page']}.php";
}
?>
