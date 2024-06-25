<?php
require 'db.php';

$additionalProducts = [];
$stmt = $conn->prepare("SELECT * FROM products WHERE added_by_admin = 1 ORDER BY RAND() LIMIT 5");
$stmt->execute();
$result = $stmt->get_result();
while ($product = $result->fetch_assoc()) {
    $additionalProducts[] = $product;
}

echo json_encode($additionalProducts);
?>
