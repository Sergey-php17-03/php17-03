<?php

namespace testing;
require_once 'helloOOD.php';
    use \sandbox\test as TEst;

require_once 'helloOOD.php';

$test1 = new TEst(First);
echo '<br>';
$test1->helloWorld();
echo '<br>';
$test1->iHave();
echo '<br>';
$test1->echoTextBold('Жирный?');