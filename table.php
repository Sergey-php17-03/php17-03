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
    array("Volvo", 22, 18),
    array("BMW", 15, 13),
    array("Saab", 5, 20),
    array("Land Rover", 17, 15)
);

$sortMethod = [0, 1, 2,];

function flag($key) {
    $flag[$key] ++;
    return $flag;
}

// data form
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $flag = flag($key);
}

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $filter = array_filter($filter);    
}

$direction = [
    '0' => '',
    '1' => '&#9660',
    '2' => '&#9650',
];

$filterFunk = function ($val) use ($filter) {
    foreach ($filter AS $key => $textFilter) {
        return $val[$key] == $textFilter;
    }
};

//$cars = array_filter($cars, $filterFunk($val));

$rSorter = function ($a, $b) use ($key) {
    $key = substr($key, 0, -2);
    return strnatcmp($b[$key], $a[$key]);
};
$sorter = function ($a, $b) use ($key) {
    return strnatcmp($a[$key], $b[$key]);
};

if (strlen($key) < 2) {
    usort($cars, $sorter);
    $sortMethod[$key] = $key . '00';
    
} else {
    usort($cars, $rSorter);
    $tmp = substr($key, 0, -2);
    $sortMethod[$tmp] = $tmp;
    $flag[$tmp]= '2';
}

// generate table

function column($data) {
    echo "<td>$data</td>";
}

echo '<form action="/table.php" method="GET">
<table border="1" width="500">
    <thead >
        <tr>
            <th>' . $direction[$flag[0]] . '<button name="key" value="' . $sortMethod[0] . '">Auto</button></th>
            <th>' . $direction[$flag[1]] . '<button name="key" value="' . $sortMethod[1] . '">Warranty Service</button></th>
            <th>' . $direction[$flag[2]] . '<button name="key" value="' . $sortMethod[2] . '">Price (Million)</button></th>
        </tr>
        <tr>
            <th><input type="text" name="filter[0]" value=""/></th>
            <th><input type="number" name="filter[1]" value=""/></th>
            <th><input type="number" name="filter[2]" value=""/></th>
        </tr>
        
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