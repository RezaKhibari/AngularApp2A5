<?php
require_once 'db_connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Read the input data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name']) && isset($data['category']) && isset($data['price']) && isset($data['image'])) {
    $name = $data['name'];
    $category = $data['category'];
    $price = $data['price'];
    $image = $data['image'];

    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, category, price, image) VALUES (:name, :category, :price, :image)");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Product added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add product"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
  }
?>