<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__;

include_once './Core/App.php';

(new Core\App())->run();

//include_once './Core/autoload.php';
//include_once 'vendor/autoload.php';
//include_once 'Classes' . DS . 'Config.php';


/*
Config::init();

$apiUrl = Config::getEnv('PROM_API_URL');
$token = Config::getEnv('PROM_TOKEN');

$prom = new LibProm($apiUrl, $token);

$orders = $prom->getOrders(0, 20);+

$prom->printOrders($orders);
*/

