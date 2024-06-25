<?php
require 'db.php';
require 'vendor/liqpay/liqpay/LiqPay.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $first_name = $data['firstName'];
    $surname = $data['surname'];
    $telephone = $data['telephone'];
    $email = $data['email'];
    $address = $data['address'];
    $address_specification = $data['addressSpecification'];
    $payment_type = $data['paymentType'];
    $cart = json_encode($data['cart']);
    $total_amount = $data['totalAmount'];
    $status = 'pending';

    $stmt = $conn->prepare("INSERT INTO orders (user_id, username, first_name, surname, telephone, email, address, address_specification, payment_type, cart, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssdss", $user_id, $username, $first_name, $surname, $telephone, $email, $address, $address_specification, $payment_type, $cart, $total_amount, $status);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false];
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
?>
