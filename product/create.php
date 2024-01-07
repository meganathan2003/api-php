<?php
// php stream - // innput

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get the database connection
include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// Below the code for get the posted data
$data = json_decode(file_get_contents("php://input"));


// Codee for check the json is not empty in single value

if (!empty($data->name) && !empty($data->price) &&  !empty($data->description) && !empty($data->category_id)) {

    // here you can see the we import that product clas
    // now we have to set the name and id using that produt class
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = date('Y-m-d H:i:s');

    // Create the product
    if ($product->create()) {
        // replace the status code
        http_response_code(201);
        // Response the user
        echo json_encode(array("message" => "Product was created."));
    }
    // if unable to create the product, tell the user
    else {
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
} // tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>