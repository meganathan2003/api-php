<?php

/*
Below the code you are the user send to the browser
using header in json format so that browser can understand that
values send as the json format
*/
// include the all files
include_once '../config/database.php';
include_once '../objects/product.php';

// Requires headers
header("Access-Control-Allow-Origin: http://localhost:3306");
header("Content-Type: application/json; charset=UTF-8");

// Below the code for creating the obj for db and 
$database = new Database();
$db = $database->getConnection();

// initilaize the obj
$product = new Product($db);


// query products
$stmt = $product->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        array_push($products_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($products_arr);
}   
