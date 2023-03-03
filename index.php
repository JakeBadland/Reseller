<?php

const DS = DIRECTORY_SEPARATOR;

//include_once '.env';
include_once 'autoload.php';
include_once 'vendor/autoload.php';
include_once 'Classes' . DS . 'Config.php';

Config::init();


$apiUrl = Config::getEnv('PROM_API_URL');
$token = Config::getEnv('PROM_TOKEN');

$prom = new libProm($apiUrl, $token);

$orders = $prom->getOrders(0, 20);

$prom->printOrders($orders);

