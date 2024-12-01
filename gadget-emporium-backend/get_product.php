<?php
// Enable CORS headers
header("Access-Control-Allow-Origin: http://localhost:4200"); // Replace with specific origin or use '*' for development
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
include 'db_connection.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(["success" => false, "message" => "Product not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid product ID."]);
}
?>