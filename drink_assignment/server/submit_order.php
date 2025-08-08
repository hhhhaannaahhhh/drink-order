<?php

require 'get_db_connection.php';
$pdo = get_db_connection();
header('Content-Type: application/json');

$name = $_POST["name"];
$drink = $_POST["drink"];
$milk = $_POST["milk"];
$extras = $_POST["extras"];
try {
    $query = "INSERT INTO orders (customer_name, customer_drink,
                    drink_milk, drink_extras) VALUES ($name, $drink, $milk, $extras)";
    $stmt = $pdo->prepare($query);

    $stmt->execute([$name, $drink, $milk, $extras]);
    echo json_encode([
        'status' => 'good',
        'message'=> 'Order success'
    ]);
} catch (PDOException $e){
    echo json_encode([
        'status' => 'fail',
        'message' => 'Cannot accept order'
    ]);
}

$query = null;
$pdo = null;
?>

