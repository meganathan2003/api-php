<?php

/* Below the code for read the one product from the 
products tables */
// required headers
header("Access-Control-Allow-Origin: http://localhost:3306");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include database and objects
include_once '../config/database.php';
include_once '../objects/product.php';

//Get the connection 
$database = new Database();
$db = $database->getConnection();

// Create a product obj 
$product = new Product($db);

// set ID property of record to read
$product->id = isset($_GET["id"]) ? $_GET["id"] : die();

// Access the readOne method 
$stmt = $product->readOne();
$num = $stmt->rowCount();
if ($num > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // now extract the row
        extract($row);
        $product_array = array( // Create a new array to set values
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        // give the http status code
        http_response_code(200);

        // Now encode to the json
        echo json_encode($product_array);
    }
} else {

    // if user give wrong id give the 404 
    http_response_code(404);

    echo json_encode(array("message" => "Product does not exist."));
}

?>
