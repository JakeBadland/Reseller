<?php

const DS = DIRECTORY_SEPARATOR;

include_once 'autoload.php';
include_once 'Classes' . DS . 'Config.php';

Config::init();

$str = 'СТРОКА В ВЕРХНЕМ РЕГИСТРЕ КИРИЛИЦА';
$str = mb_strtolower($str);

echo "<PRE>";
var_dump($str);
echo "</PRE>";

die('test');


$apiUrl = Config::get('prom', 'api_url');
$token = Config::get('prom', 'token');

$prom = new libProm($apiUrl, $token);

$orders = $prom->getOrders(0, 20);

$prom->printOrders($orders);



//parseAddress("Костянтинівка (Донецька обл.), №31312321:(до 200 кг) вул. Громова, 9а");

//$curl = $client->getCurl($url . $path . '?'.http_build_query(array('status'=>'pending')));

/*
$dir = Config::get('settings', 'xls_dir');
$fileName = realpath($dir . DS . 'sheet1.xml');

echo "<pre>";
var_dump($dir);
var_dump($fileName);
echo "</pre>";

$xls = new LibXls();
*/


