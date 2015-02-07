<?php

class Fillio_ServerLogic_Bootstrap {
    
    public function __construct() {
        $this->run();
    }

    public function run() {
        $class_methods = get_class_methods(get_called_class());
        if (count($class_methods)) {
            foreach ($class_methods as $method_name) {
                if (substr($method_name, 0, 4) == "init") {
                    $this->$method_name();
                }
            }
        }
    }

}
