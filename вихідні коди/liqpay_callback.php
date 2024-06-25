<?php
require 'db.php';
require 'vendor/liqpay/liqpay/LiqPay.php';

$config = include('config.php');
$public_key = $config['public_key'];
$private_key = $config['private_key'];

$liqpay = new LiqPay($public_key, $private_key);

$data = $_POST['data'];
$signature = $_POST['signature'];

$decoded_data = $liqpay->decode_params($data);
$generated_signature = base64_encode(sha1($private_key . $data . $private_key, 1));

if ($signature === $generated_signature && $decoded_data['status'] === 'success') {
    // Update the order status in the database
    $order_id = $decoded_data['order_id'];
    $stmt = $conn->prepare("UPDATE orders SET status = 'success' WHERE order_id = ?");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
}
?>
