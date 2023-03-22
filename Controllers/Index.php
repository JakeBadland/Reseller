<?php

namespace Controllers;

class Index extends \Core\BaseController {

    public function index($id = null)
    {
        if (!$id){
            $this->redirect('/index/index/5');
        }

        $config = $this->getConfig();
        $db = new \Core\Libs\LibDb($config['database']);

        $apiUrl = $db->select('value')->from('settings')->where("`key` = 'PROM_API_URL'")->findOne()['value'];
        $shopInfo = $db->select('*')->from('shops')->where("id = $id")->findOne();

        $shops = $db->select('*')->from('shops')->find();

        $prom = new \Core\Libs\LibProm($apiUrl, $shopInfo['token']);
        $parser = new \Helpers\OrderParser();

        $orders = $prom->getOrders(0, 20);

        $data = [];
        
        foreach ($orders as $order){
            $data[] = $parser::parseOrder($order, $shopInfo['name']);
        }

        $this->render('Test', [
            'orders' => $data,
            'shops' => $shops,
            'color' => $shopInfo['color']
        ]);
    }

}