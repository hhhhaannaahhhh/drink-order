<?php
require 'M:\Users\haf31\secret\db_secret.php';
function get_db_cnnection(){
    $data_source_name = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;
    try{
        return new PDO($data_source_name, DB_USER, DB_PASSWORD);
    } catch (PDOException $e){
        echo "cannot connect".$e."\n";
        return NULL;
    }
}
?>
