<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
include 'db_connection.php';

// Decode the JSON payload
$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? intval($input['id']) : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete product."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid product ID."]);
}
?>