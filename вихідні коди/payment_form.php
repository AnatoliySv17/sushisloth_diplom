<?php
$config = include('config.php');
require_once('vendor/liqpay/liqpay/LiqPay.php');

$liqpay = new LiqPay($config['public_key'], $config['private_key']);

$html = $liqpay->cnb_form(array(
    'action'         => 'pay',
    'amount'         => '1',
    'currency'       => 'UAH',
    'description'    => 'Описание платежа',
    'order_id'       => 'order_id_1',
    'version'        => '3',
    'sandbox'        => '1', // Уберите строку для реальных платежей
));

echo $html;

?>
