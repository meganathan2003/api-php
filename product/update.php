<?php 

/* Below the code for update the product from 
products tables 
*/

header("Access-Control-Allow-Origin: http://localhost:3306");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the objects and database
include_once '../config/database.php';
include_once '../objects/product.php';

// Get the connection
$database =  new Database();
$db = $database->getConnection();

$products = new $product($db);

// Get id product form the product obj
echo json_decode(file_get_contents('php://input'));



?>