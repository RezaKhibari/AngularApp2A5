 <?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Include database connection
include('db_connection.php');

// Get the 'category' query parameter from the request
$category = isset($_GET['category']) ? $_GET['category'] : '';

try {
    if ($category) {
        // Prepare the statement with a parameterized query
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category");
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    } else {
        // Prepare the statement without a filter
        $stmt = $pdo->prepare("SELECT * FROM products");
    }

    // Execute the statement
    $stmt->execute();

    // Fetch the results into an array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as a JSON response
    echo json_encode($products);
} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
