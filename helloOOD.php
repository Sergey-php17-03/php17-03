<?php
namespace sandbox;
require_once __DIR__ .'/traits.php';

interface hello {

    public function helloWorld();
}

abstract class OODtry {
    //put your code here
}

class test extends OODtry implements hello {
    
    public $name;


    use \Traits\Echos;

    public function __construct($name = 'Безимянный') {
        $this->name = $name;
        echo "<br>Новый объект по имени '$this->name', класса test успешно создан.<br>";
    }

    public function helloWorld() {
        
        echo $this->name . ' speak: ' . get_class_methods(get_class())[1];
    }
    
    public function iHave() {
        $methods = get_class_methods(get_class());
        $i = 1;
        $func = '';

        echo $this->name . ' have: ';
        foreach ($methods as $method) {
            $func .= ' ' . $i . ')' . $method;
            $i ++;
        }
        echo $func;
    }

}
