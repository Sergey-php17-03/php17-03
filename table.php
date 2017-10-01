<?php

/*
  нужно выводить его в виде таблицы через table thead/tbody tr th/td
  в строку заголовков добавить стрелочки через input type button
  стрелочки/треугольнички можно выбрать здесь https://ru.wikipedia.org/wiki/%D0%9C%D0%BD%D0%B5%D0%BC%D0%BE%D0%BD%D0%B8%D0%BA%D0%B8_%D0%B2_HTML
  чтобы кликая название машины, сортировались данные по возрастанию/убыванию
  сортировку сделать через usort
  примерно как должно работать -
  http://i.prntscr.com/nM8A9KnISjq2i9Ifc-4fzg.png
  http://js-grid.com/demos/

  усложнение
  добавить поле сортировки и через array filter отсеивать лишние данные

  самая полная версия должна работать примерно как здесь
  http://i.prntscr.com/ibfSlZXsT5uJtFErMx42eQ.png

 */

// есть массив машин
$cars = array
    (
    array('Auto' => "Volvo", 'Warranty Service' => 22, 'Price' => 18),
    array('Auto' => "BMW", 'Warranty Service' => 15, 'Price' => 13),
    array('Auto' => "Saab", 'Warranty Service' => 5, 'Price' => 20),
    array('Auto' => "Land Rover", 'Warranty Service' => 17, 'Price' => 15)
);

$columsNames = array_keys($cars[0]);
$order = [
    'Auto' => '0',
    'Warranty Service' => '0',
    'Price' => '0'
];

$direction = [
    '0' => '',
    'desc' => '&#9660',
    'asc' => '&#9650',
];

// data form

if (isset($_GET['key'])) { 
    list($key, $tmp) = explode('#', $_GET['key']);
    $order[$key] = $tmp;
    $search = array_filter($_GET['search']);
}

$searchFunc = function ($val) use ($search) {
    foreach ($search AS $key => $textsearch) {
        return stripos($val[$key], $textsearch) !== false;
    }
};

if (!empty($search)) {
    $cars = array_filter($cars, $searchFunc);
}

$sorter = function ($a, $b) use ($key, $order) {
    $args = [
        '0' => 1,
        'asc' => 1,
        'desc' => -1
    ];
    return strnatcmp($a[$key], $b[$key]) * $args[$order[$key]];
};
usort($cars, $sorter);

// generate table

function column($data) {
    echo "<td>$data</td>";
}

if ($order[$key] == 'asc'  || $order[$key] == '0' ) {
    $order[$key] = 'desc';
} else {
    $order[$key] = 'asc';
};

echo '<form action="/table.php" method="GET">
<table border="1" width="500">
    <thead >
    <tr>';

foreach ($columsNames AS $columName) {
    $data = '<button name="key" value="'. $columName .'#'. $order[$columName] . '">'
        .$direction[$order[$columName]] .' '. $columName . '</button>';
    column($data);
}
echo '</tr><tr>';

foreach ($columsNames AS $columName) {
    $data = '<input type="text" name="search[' . $columName . ']" value=""/>';
    column($data);
}
echo '</tr>        
    </thead>
    <tbody >';

foreach ($cars AS $item) {
    echo '<tr>';
    foreach ($item AS $data) {
        column($data);
    }
    echo '</tr>';
}
echo'</tbody>
</table>
    </form>';