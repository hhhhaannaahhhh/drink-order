<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
$name   = isset($_GET['name'])   ? trim($_GET['name'])   : '';
$drink  = isset($_GET['drink'])  ? trim($_GET['drink'])  : '';
$milk   = isset($_GET['milk'])   ? trim($_GET['milk'])   : '';
$extras = isset($_GET['extras']) ? trim($_GET['extras']) : '';
require 'get_db_connection.php';
$conn = get_db_connection();
try {
    $stmt = $conn->prepare(
        "INSERT INTO orders
           (customer_name, customer_drink, drink_milk, drink_extras)
         VALUES
           (:name, :drink, :milk, :extras)
         RETURNING order_number"
    );
    $stmt->execute([
        ':name'   => $name,
        ':drink'  => $drink,
        ':milk'   => $milk,
        ':extras' => $extras
    ]);
    $order_number = (int)$stmt->fetchColumn();
    echo json_encode([
        'status'       => 'ok',
        'order_number' => $order_number
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Insert failed: '.$e->getMessage()
    ]);
}
$stmt = null;

$conn  = null;