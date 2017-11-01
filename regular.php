<?PHP

//к нам на PHP приходит телефон, пусть $_POST['phone']
//нужно проверять является ли номер корректно введенным украинским и номером мобильного оператора
//рассматривать формат
//+38(098)765-43-21
//усложнение, чтобы регулярка любой вариант рассматривала

$operator = [
    '039' => 'Киевстар (Golden Telecom)',
    '050' => 'МТС',
    '063' => 'lifecell',
    '066' => 'МТС',
    '067' => 'Киевстар',
    '068' => 'Киевстар (Beeline)',
    '073' => 'lifecell',
    '091' => 'Utel',
    '092' => 'PEOPLEnet',
    '093' => 'lifecell',
    '094' => 'Интертелеком',
    '095' => 'МТС',
    '096' => 'Киевстар',
    '097' => 'Киевстар',
    '098' => 'Киевстар',
    '099' => 'МТС'
];

$defaultNumber = [
    '+38(098)765-43-21',
    '0987654321',
    '(098)7654321',
    '098 765 43 21',
    '098-765-43-21',
    '+380987654321',
    '+380 98 765 43 21',
    '(+380) 987654321',
    '(+38) 0987654321'
];

$checkText = [
    'ok' => 'Номер обслуживается мобильным оператором - %s',
    'error' => ' Проверьте правильность ввода.',
];

$pattern = [
    'strict' => [
        'pattern' => '#^\+38\((039|050|06[3678]|073|09[1-9])\)\d{3}(-\d{2}){2}$#',
        'buttonName' => 'Строгий<br> шаблон',
        'code' => "$rezult[1]"
    ],
    'loyal' => [
        'pattern' => '#^\(?\+?3?8?\)? ?\(?0\)? ?(39|50|6[3678]|73|9[1-9])\)?([-| ]*\d){7}$#',
        'buttonName' => 'Лояльный<br> шаблон',
        'code' => "0$rezult[1]"
    ]
];

// form data

if (isset($_POST['submit'])) {
    $phone = trim($_POST['phone']) ?: $phone = $defaultNumber[mt_rand(0, 8)];

    $checkNumber = $checkText['error'];

    if (preg_match($pattern[$_POST['submit']]['pattern'], $phone, $rezult)) {
        $code = eval($pattern[$_POST['submit']]['code']);
        echo $code;
        $checkNumber = sprintf($checkText['ok'], $operator[$code]);
    }
}

// form view

    echo '<form action="/regular.php" method="POST">
    <p>Номер мобильного телефона в Украине*</p>
    <input type="tel" name="phone" placeholder="+38(0__)___-__-__" value="' . $phone . '" /><br>'
    . $checkNumber . '<br><br>';
    foreach ($pattern as $value => $properties) {
        echo '<button name="submit" value="' . $value . '"/><b>' . $properties['buttonName'] . '</b></button>';
    }
    echo '<p>* При нажатии кнопки с пустой формой, результатом будет проверка 1-го случайного номера из списка в задании.</p>
</form>';
    