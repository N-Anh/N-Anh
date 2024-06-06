<?php 
define('DATABASE_SERVER', 'localhost');
define('DATABASE_PORT', '3307');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_NAME', 'sales');

$connection = null;
try {
    $dsn = "mysql:host=".DATABASE_SERVER.";port=".DATABASE_PORT.";dbname=".DATABASE_NAME;
    $connection = new PDO($dsn, DATABASE_USER, DATABASE_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection successfully";
}catch(PDOException $e) {
    echo "Connection failed: " .$e->getMessage();
    $connection = null;
}
?>

