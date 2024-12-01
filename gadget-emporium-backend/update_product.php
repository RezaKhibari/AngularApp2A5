<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// If it's a preflight request, return a success response
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include('db_connection.php');

// Get data from the request (expected to be JSON)
$data = json_decode(file_get_contents("php://input"), true);

// Validate input data
if (isset($data['id'], $data['name'], $data['category'], $data['price'])) {
    $id = $data['id'];
    $name = $data['name'];
    $category = $data['category'];
    $price = $data['price'];
    $image = $data['image'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $name, $category, $price, $image, $id);

    // Execute the update
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Product updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update product.']);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data received.']);
}

// Close the database connection
$pdo->close();
?>