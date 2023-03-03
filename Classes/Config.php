<?php

class Config {

    static $config = null;

    public static function init()
    {
        $configFile = __DIR__ . DS . '..' . DS . 'config.php';

        if(!file_exists($configFile)){
            self::writeDefault($configFile);
        }

        self::$config = include_once($configFile);
    }

    public static function getEnv($param)
    {
        $env = parse_ini_file('.env');

        foreach ($env as $key => $item){
            if ($key == $param) return $item;
        }

        return null;
    }

    public static function get($section = null, $key = null)
    {
        if (!$section){
            return self::$config;
        }

        if (!array_key_exists($section, self::$config)){
            return null;
        }

        if ($key){
            if (!array_key_exists($key, self::$config[$section])){
                return null;
            }

            return self::$config[$section][$key];
        }

        return self::$config[$section];
    }

    private static function writeDefault($fileName)
    {
        $content ="
<?php

return [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'db_name' => ''
    ],

    'settings' => [
    ],

    'routes' => [

    ],

];
";

        file_put_contents($fileName, $content);
    }

}