<?php
// connect to databse
$host = "db.dcs.aber.ac.uk";
$dbname ="cs25320_24_25_haf31";
$user = "haf31";
$password = "Ilovestanley5#5";
// read json sent and turn it into data
$data = json_decode(file_get_contents("php://input"), true);

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
$conn_string ="host = $host dbname=$dbname user=$user password=$password";
$db =pg_connect($conn_string);
$result = pg_query_params(
    $db, "INSERT INTO orders (customer_name, customer_drink, drink_milk, extras) VALUES ($1, $2, $3, $4)",
    array($name, $drink, $milk, $extras)
);
pg_close($db);