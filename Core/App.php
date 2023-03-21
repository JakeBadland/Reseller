<?php

namespace Core;

class App {

    public $request;
    public $config;

    public function run()
    {
        $this->init();

        spl_autoload_register(function ($class){
            $this->autoload($class);
        });

        $this->parseRequest();
        $this->call();
    }

    public function init()
    {

    }

    private function autoload($class)
    {
        $classFile = __DIR__ . DS . '..' . DS . $class . '.php';

        if (is_file($classFile)){
            include_once $classFile;
        }
    }

    public function parseRequest()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url = parse_url($url);

        $url['path'] = trim($url['path'], '/');

        $url['path'] = explode('/', $url['path']);

        $this->request = $url;

        if (isset($url['path'][0])){
            $this->request['class'] = $url['path'][0];
        }

        if (isset($url['path'][1])){
            $this->request['method'] = $url['path'][1];
        }

        if (isset($url['path'][2])){
            $this->request['param'] = $url['path'][2];
        }
    }

    private function call()
    {
        $className = ucfirst($this->request['class']);

        if (!isset($this->request['method'])){
            $method = 'index';
        } else {
            $method = $this->request['method'];
        }

        if (!isset($this->request['param'])){
            $param = null;
        } else {
            $param = $this->request['param'];
        }

        $class = '\\Controllers\\'.$className;

        $class = new $class();

        $class->$method($param);
    }

    public function render($view, $data = null)
    {
        $renderer = new \Core\Libs\LibRenderer();

        $class = explode('\\', get_called_class());

        $class = $class[count($class) - 1];
        
        //extract($data);
        
        $renderer->render($class. DS . $view, $data);
    }

    public function getConfig()
    {
        if (!$this->config){
            $configFile = __DIR__ . DS . '..' . DS . 'Configs' . DS . 'config.php';

            if (!is_file($configFile)){
                throw new \Exception('Configs' . DS . 'config.php file not found!');
            }

            $this->config = include $configFile;
        }

        return $this->config;
    }

    public static function getEnv($param)
    {
        $env = parse_ini_file( __DIR__ . DS . '..' . DS . '.env');

        foreach ($env as $key => $item){
            if ($key == $param) return $item;
        }

        return null;
    }

}