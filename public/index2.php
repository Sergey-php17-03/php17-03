<?php
/**
 * Created by PhpStorm.
 * User: UITS-Student
 * Date: 31.10.2017
 * Time: 20:10
 */

require '../vendor/autoload.php';

$curl = new \Curl\Curl();
$curl->get('http://php.net/manual/ru/book.curl.php');

if ($curl->error) {
    echo $curl->error_code;
}
else {
    echo $curl->response;
}