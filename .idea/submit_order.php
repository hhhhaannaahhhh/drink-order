<?php
header('Content-Type: application/json');
// connect to databse
$host = "db.dcs.aber.ac.uk";
$dbname ="cs25320_24_25_haf31";
$user = "haf31";
$password = "Ilovestanley5#5";
// read json sent and turn it into data
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$name = $data['name'];
$drink = $data['drink'];
$milk = $data['milk'];
// write extras only if they exist
if (isset($data['extras'])) {
    $extras = implode(", ", $data['extras']);
} else {
    $extras = '';
}
// connect to database
$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$db =pg_connect($conn_string);
$sql = "INSERT INTO orders (customer_name, customer_drink, drink_milk, drink_extras, order_finished)
VALUES ($1, $2, $3, $4, FALSE)";
$result = pg_query_params($db, $sql, [$name, $drink, $milk, $extras]);
if ($result){
    echo json_encode([
        'status' => 'completed',
        'message' => 'order saved'
    ]);
}
pg_close($db);
?>