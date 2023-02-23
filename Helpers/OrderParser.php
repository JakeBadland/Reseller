<?php

class OrderParser{

    public static function parseOrder($order) : PromOrder
    {
        $result = new PromOrder();

        $date = strtotime($order->date_created);
        $date = date('d.m.Y', $date);

        $result->store = 'Юг/опт';
        $result->name = trim($order->client_first_name) . ' ' . trim($order->client_last_name);
        $result->phone = trim($order->phone, '+');
        $result->address = self::parseAddress($order->delivery_address, $order->delivery_provider_data);
        $result->deliveryProvider = self::parseDelivery($order->delivery_address, $order->delivery_provider_data);
        $result->date = $date;
        $result->id = $order->id;
        $result->price =  preg_replace('/[^0-9]/', '', $order->full_price);

        $result->system = 'S_OK';

        /*

        $description;//I [п
        $purchaseType;//J т
        $description1 = '';
        $description2 = '';
        */

        return $result;

    }

    private static function parseDelivery($deliveryAddress, $deliveryData) : ?string
    {
        if (!isset($deliveryData->provider)){
            //return '$deliveryData->provider not set';
            return '';
        }

        switch ($deliveryData->provider){
            case 'nova_poshta' : {
                return 'Новая почта ' . self::getDelivery($deliveryAddress);
            }
            default: return '$deliveryData->provider not accepted: ' . $deliveryData->provider;
        }
    }

    private static function getDelivery($addr)
    {
        $pattern = "/№(?P<digit>\d+)/";
        preg_match_all($pattern, $addr,$out, PREG_PATTERN_ORDER);

        $result = (!empty($out[0][0])) ? $out[0][0]: null;

        if (!$result){
            $pattern = "/№\s(?P<digit>\d+)/";
            preg_match_all($pattern, $addr,$out, PREG_PATTERN_ORDER);

            $result = (!empty($out[0][0])) ? $out[0][0]: null;
            $result = str_replace(' ', '', $result);
        };

        return $result;
    }

    private static function parseAddress($deliveryAddress, $deliveryData) : ?string
    {
        if (!isset($deliveryData->provider)){
            return '';
        }

        switch ($deliveryData->provider){
            case 'nova_poshta' : {
                return self::parseNovaPoshta($deliveryAddress);
            }
            default: return '';
        }
    }

    private static function parseNovaPoshta($address) : ?string
    {
        return $address;
    }

}