<?php

namespace Controllers;

class Index extends \Core\BaseController {

    public function test($param = null)
    {
        $apiUrl = $this->getEnv('PROM_API_URL');
        $token = $this->getEnv('PROM_TOKEN');


        $prom = new \Core\Libs\LibProm($apiUrl, $token);
        $parser = new \Helpers\OrderParser();

        $orders = $prom->getOrders(0, 20);

        $data = [];
        
        foreach ($orders as $order){
            $data[] = $parser::parseOrder($order);
        }

        $this->render('Test', ['orders' => $data]);

    }

}