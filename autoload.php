<?php

spl_autoload_register(function ($class) {

    $dirs = Config::get('autoloads');

    foreach ($dirs as $dir){
        //$fileName = __DIR__ . DS . $dir . DS . $class . '.php';

        $fileName = '.' . DS . $dir . DS . $class . '.php';

        if (file_exists($fileName)) {
            require_once $fileName;
            return;
        }
    }

});