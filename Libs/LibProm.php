<?php
//define('AUTH_TOKEN', '0bdfa79dd84a89d0ce54e02eed6a212d38c20e9b');  // Your authorization token
//define('HOST', 'my.prom.ua');  // e.g.: my.prom.ua, my.tiu.ru, my.satu.kz, my.deal.by, my.prom.md

class LibProm {

    private $token;
    private $apiUrl;

    public function __construct($url, $token) {
        $this->token = $token;
        $this->apiUrl = $url;
    }

    public function getOrders($page, $limit)
    {
        $path = '/api/v1/orders/list';
        $client = new LibCurl();

        $params = ['page' => $page, 'per_page' => $limit];
        $url = $this->apiUrl . $path . '?'.http_build_query($params);
        $headers = ['Authorization: Bearer ' . $this->token, 'Content-Type: application/json'];

        $result = $client->execute($url, $headers);

        return json_decode($result->body)->orders;
    }

    public function printOrders($orders)
    {

        echo "<TABLE>";
        foreach ($orders as $item){

            $order = OrderParser::parseOrder($item);

            /*
            if (!$item->delivery_address){
                echo '<PRE>';
                var_dump($item);
                echo '</PRE>';
                die;
            }
            */

            $back = '';
            if (!$order->address){
                $back = "style='background-color: red'>";
                $order->address = 'Не удалось определить адресс!';
            }

            echo "<TR $back>";
            echo "<TD>{$order->store}</TD>";
            echo "<TD>{$order->name}</TD>";
            echo "<TD>{$order->phone}</TD>";
            echo "<TD>{$order->address}</TD>";
            echo "<TD>{$order->date}</TD>";
            echo "<TD>{$order->id}</TD>";
            echo "<TD>{$order->price}</TD>";
            echo "<TD>{$order->deliveryProvider}</TD>";
            echo "<TD></TD>";
            echo "</TR>";
        }
        echo "</TABLE>";

    }

    /**
     * Получить список заказов
     * @param string $status Возможные статусы заказов: pending - вновь созданный; received - принят в обработку; canceled - отменен
     * @return array
     */
    public function getOrderList($status = NULL)
    {
        $url = '/api/v1/orders/list';
        if ( !is_null($status) )
        {
            $url = $this->apiUrl . '?'.http_build_query(array('status'=>$status));
        }
        $method = 'GET';

        $response = $this->make_request($method, $url, NULL);

        return $response;
    }

    public function getOrderById($id)
    {
        $url = '/api/v1/orders/' . $id;
        $method = 'GET';

        return $this->make_request($method, $url, NULL);
    }

    /**
     * Изменять статус заказа.
     * @param array $ids Массив номеров заказов
     * @param string $status Статус [ pending, received, delivered, canceled, draft, paid ]
     * @param string $cancellation_reason Только для статуса canceled [ not_available, price_changed, buyers_request, not_enough_fields, duplicate, invalid_phone_number, less_than_minimal_price, another ]
     * @param string $cancellation_text Толкьо для причины отмены "price_changed", "not_enough_fields" или "another"
     * @return array
     */
    function setOrderStatus($ids, $status, $cancellation_reason = NULL, $cancellation_text = NULL)
    {
        $url = '/api/v1/orders/set_status';
        $method = 'POST';

        $body = array (
            'status'=> $status,
            'ids'=> $ids
        );

        if ( $status === 'canceled' )
        {
            $body['cancellation_reason'] = $cancellation_reason;

            if ( in_array($cancellation_reason,array('price_changed', 'not_enough_fields', 'another')) )
                $body['cancellation_text'] = $cancellation_text;
        }

        return $this->make_request($method, $url, $body);
    }
}

/*
if (empty(AUTH_TOKEN)) {
    throw new Exception('Sorry, there\'s no any AUTH_TOKEN');
}

$client = new EvoExampleClient(AUTH_TOKEN);

$order_list = $client->get_order_list();
if (empty($order_list['orders'])) {
    throw new Exception('Sorry, there\'s no any order');
}
// echo var_dump($order_list);

$order_id = $order_list['orders'][0]['id'];

$order = $client->get_order_by_id($order_id);
// echo var_dump($order);

$set_status_result = $client->set_order_status((array) $order_id, 'received', NULL, NULL);
// echo var_dump($set_status_result);

$order = $client->get_order_by_id($order_id);
// echo var_dump($order);
*/