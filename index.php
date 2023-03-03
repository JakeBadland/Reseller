<?php

const DS = DIRECTORY_SEPARATOR;

include_once 'autoload.php';
include_once 'Classes' . DS . 'Config.php';

/*
$dt = new \DateTime();
$dt->setTimestamp(1584915938);
echo $dt->format('Y.m.d H:i:s');
die;
*/

Config::init();

$apiUrl = Config::get('prom', 'api_url');
$token = Config::get('prom', 'token');

$prom = new libProm($apiUrl, $token);

$orders = $prom->getOrders(0, 20);

$prom->printOrders($orders);

