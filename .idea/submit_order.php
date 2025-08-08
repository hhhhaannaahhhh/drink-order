<?php
require 'get_db_connection.php';
$conn = get_db_connection();
header('Content-Type: application/json');

$query = $conn->prepare("insert into orders (customer_name, customer_drink,
                    drink_milk, drink_extras) values (:name, :drink, :milk, :extras)
                        ");

$query->bindParam(':name', $name);
$query->bindParam(':drink', $drink);
$query->bindParam(':milk', $milk);
$query->bindParam(':extras', $extras);

$query->execute();
header('Content-Type: application/json');
echo json_encode([
    'status'=>'ok',
    'order_number'=>(int)$query->fetch(PDO::FETCH_COLUMN)
]);

$query = null;
$conn = null;
?>

