<?php
include './database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql_delete_product = "DELETE FROM products WHERE product_id = ?";
    $stmt_delete_product = $connection->prepare($sql_delete_product);
    $stmt_delete_product->execute([$product_id]);
    header('Location: product_list.php');
    exit();
} 
?>
