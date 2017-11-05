<?php
namespace testing;
require_once __DIR__ .'/helloOOD.php';
    use \sandbox\test as TEst;

$test1 = new TEst(First);
echo '<br>';
$test1->helloWorld();
echo '<br>';
$test1->iHave();
echo '<br>';
$test1->echoTextBold('Жирный?');