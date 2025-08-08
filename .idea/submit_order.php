<?php
require 'get_db_connection.php';
$conn = get_db_connection();

$input = json_decode(file_get_contents('php://input'), true);
$name = $input['name'];
$drink = $input['drink'];
$milk = $input['milk'];
$extras = implode(', ', $input['extras']);

$query = $conn->prepare("INSERT INTO orders (customer_name, customer_drink,
                    drink_milk, drink_extras) VALUES (:name, :drink, :milk, :extrs)
                    RETURNING order_number");

$query->bindParam(':name', $name);
$query->bindParam(':drink', $drink);
$query->bindParam(':milk', $milk);
$query->bindParam(':extras', $extras);

try {
    $query->execute();
    $order_number = $query->getch(PDO::FETCH_COLUMN);
    echo json_encode([
        'status'=>'good',
        'order_number'=> $order_number
    ]);
} catch (PDOException $e){
    echo json_encode([
        'status'=>'error',
        'message'=>'failed'
    ]);

}
$query = null;
$conn = null;







?>