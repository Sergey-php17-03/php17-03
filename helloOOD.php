<?php

namespace sandbox;

interface hello {

    public static function helloWorld();
}

abstract class OODtry {
    //put your code here
}

class test extends OODtry implements hello {

    public function __construct() {
        echo "Новый объект класса test успешно создан.<br>";
    }

    public static function helloWorld() {
        echo get_class() . ' speak: ' . get_class_methods(get_class())[1];
    }

    public function iHave() {
        $methods = get_class_methods(get_class());
        $i = 1;

        echo get_class() . ' have: ';
        foreach ($methods as $method) {
            $func .= ' ' . $i . ')' . $method;
            $i ++;
        }
        echo $func;
    }

}
