<?php
include('../Assets/Connection/Connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Home</title>
</head>
<body>
    <h1>Welcome</h1>
    <?php 

echo $_SESSION['sname'];
?>
    <a href="product.php">Add Product</a>
    
</body>
</html>