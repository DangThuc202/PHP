<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/ProductModel.php';

$database = new Database();
$db = $database->getConnection();

$product = new ProductModel($db);

$result = $product->readAll();

$num = $result->rowCount();

if ($num > 0) {

    $products_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            'productId' => $productid,
            'name' => $name,
            'origin' => $origin,
            'price' => $price,
            'color' => $color,
            'width' => $width,
            'height' => $height,
            'weight' => $weight,
            'image' => $image,
            'description' => $description,
        );
        array_push($products_arr, $product_item);
    }

    echo json_encode($products_arr);

} else {
    echo json_encode(
        array('message' => "Not found")
    );
}
?>