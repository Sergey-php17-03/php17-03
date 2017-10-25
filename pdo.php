<?php

$db_params = [
    'host' => 'localhost',
    'dbname' => 'php17-03',
    'user' => 'root',
    'pass' => '',
];

try {
    $conn = new PDO("mysql:dbname={$db_params['dbname']};host={$db_params['host']};charset=utf8", "{$db_params['user']}", "{$db_params['pass']}");
    
} catch (PDOException $err) {
    echo "Описане ошибки <br/> $err";
}

$userAdd = $conn->prepare("INSERT INTO our_group (name, role) VALUES (:name , :role)");
$userAdd->bindParam(':name', $userName);
$userAdd->bindParam(':role', $role);

$usersNew = [
    'Andrey Kormush',
    'Denis Nekrasov',
    'Evgeniy Subbota',
    'kirill suhovei',
    'Sergey Lyzko',
    'Nataly Pavlenko',
    'Pavel Gadashevich',
    'zvyagincev_evgen'
];

$role = 'student';

//foreach ($usersNew as $userName){
//    $userAdd->execute();
//}

$sql = "SELECT name, birthday, role FROM our_group";
$result = $conn->query($sql);
$users = $result->fetchAll(PDO::FETCH_ASSOC);

$columsNames = array_keys($users[0]);


// view table
function column($data) {
    echo "<td>$data</td>";
}

echo '<table border="1"  width="500">
    <thead >
    <tr>';
column('<b>age</b>');
foreach ($columsNames AS $columName) {
    column("<b>$columName</b>");
    }
echo '</tr>        
    </thead>
    <tbody >';

foreach ($users AS $item) {
    echo '<tr>';
    
    $age = date('Y-m-d h:i:s') - $item['birthday'];
    if ($age == date('Y')){
        $age = 'нет данных';
    }
    column($age);
    foreach ($item AS $data) {        
        column($data);
    }
    echo '</tr>';
}
echo'</tbody>
</table>';
