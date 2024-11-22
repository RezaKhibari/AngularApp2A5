 <?php 
// header('Content-Type: application/json');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");

// require_once 'db_connection.php';

// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $stmt = $pdo->query('SELECT * FROM products');
//     $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     echo json_encode($products);
//     exit;
// }
// Include the database connection file
require_once 'db_connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

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
