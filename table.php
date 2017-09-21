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
 */

/*
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
    array("Saab", 5, 2),
    array("Land Rover", 17, 15)
);


if (isset($_GET['sort'])){
$sort = $_GET['sort'];
}
$count = count($cars);
$flag = function ($sort){
    static $sort;
    if (empty($sort)){
        $method = 3;
    }else{$method = $sort%2;}
    $mnemo = array ('&#9660', '&#9650', ' ');
    return (string) $mnemo[$method];
};
// generate table
echo '<form action="/table.php" method="GET">
<table border="1" width="500">
    <thead >
        <tr>
            <th>'; echo $flag($sort); echo'<button name="sort" value="1">Auto</button></th>
            <th>'; echo $flag($sort); echo'<button name="sort" value="1">Warranty Service</button></th>
            <th>'; echo $flag($sort); echo'<button name="sort" value="1">Price (Million)</button></th>
        </tr>
        <tr>
            <th><input type="text" name="searchAuto" value=""/></th>
            <th><input type="text" name="$searchWarrantyService" value=""/></th>
            <th><input type="text" name="$searchPrice" value=""/></th>
        </tr>
        
    </thead>
    <tbody >';

foreach ($cars as $car) {
    echo"<tr>"
    . "<td>$car[0]</td>"
    . "<td>$car[1]</td>"
    . "<td>$car[2]</td>"
    . "</tr>";
}

echo'</tbody>
</table>
    </form>';

