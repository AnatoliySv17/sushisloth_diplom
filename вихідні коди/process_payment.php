<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';
require_once('ventor\liqpay\liqpay\LiqPay.php');

$config = include('config.php');
$public_key = $config['liqpay_public_key'];
$private_key = $config['liqpay_private_key'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $liqpay = new LiqPay($public_key, $private_key);

    // Получение суммы из корзины пользователя
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $totalAmount = array_reduce($cart, function($sum, $item) {
        return $sum + $item['price'] * $item['quantity'];
    }, 0) + 59; // Например, добавление стоимости доставки

    $html = $liqpay->cnb_form(array(
        'action'         => 'pay',
        'amount'         => round($totalAmount, 2),
        'currency'       => 'UAH',
        'description'    => 'Оплата замовлення',
        'order_id'       => 'order_' . time(),
        'version'        => '3',
        'sandbox'        => '1' // Удалите эту строку для боевой среды
    ));
    echo $html;
}

