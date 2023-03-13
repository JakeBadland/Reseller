<?php

namespace Core;

class App {

    public function run()
    {
        $this->init();

        spl_autoload_register(function ($class){
            $this->autoload($class);
        });

        $this->parseRequest();
    }

    private function init()
    {
        $configFile = __DIR__ . DS . '..' . DS . 'Configs' . DS . 'config.php';

        if (!is_file($configFile)){
            throw new \Exception('Configs' . DS . 'config.php file not found!');
        }

        $this->config = include $configFile;
    }

    private function autoload($class)
    {
        $classFile = __DIR__ . DS . '..' . DS . $class . '.php';

        if (!is_file($classFile)){
            throw new \Exception("Class: $class not found");
        }

        include_once $classFile;
    }

    private function parseRequest()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url = parse_url($url);

        $url['path'] = explode('/', $url['path']);

        echo "<PRE>";
        //var_dump($url);
        var_dump($url['path']);
        echo "</PRE>";

    }

}