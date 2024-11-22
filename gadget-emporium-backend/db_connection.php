<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'gadget_emporium';
$username = 'root'; 
$password = '123456';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>