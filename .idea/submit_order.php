<?php

require 'get_db_connection.php';
$conn = get_db_connection();
header('Content-Type: application/json');

$name = $_POST["name"];
$drink = $_POST["drink"];
$milk = $_POST["milk"];
$extras = $_POST["extras"];
if(is_array($extras)){
    $extras = implode(', ',$extras);
}

$query = "INSERT INTO orders (customer_name, customer_drink,
                    drink_milk, drink_extras) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);

$stmt->execute([$name, $drink, $milk, $extras]);

$query = null;
$conn = null;
?>

