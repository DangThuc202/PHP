<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/ProductModel.php';

$database = new Database();
$db = $database->getConnection();

$product = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

    if (stripos($content_type, 'application/json') !== false) {
        $data = json_decode(file_get_contents("php://input"));
    } elseif (stripos($content_type, 'application/x-www-form-urlencoded') !== false) {
        $data = (object) $_POST;
    } else {
        echo json_encode(array('message' => 'Loại dữ liệu không được hỗ trợ'));
        exit;
    }

    if (
        isset($data->name) && isset($data->origin) &&
        isset($data->price) && isset($data->color) &&
        isset($data->width) && isset($data->weight) &&
        isset($data->height) && isset($data->image) && isset($data->description)
    ) {
        $name = $data->name;
        $origin = $data->origin;
        $price = $data->price;
        $color = $data->color;
        $width = $data->width;
        $weight = $data->weight;
        $height = $data->height;
        $image = $data->image;
        $description = $data->description;


        if ($product->addProduct($name, $origin, $price, $color, $width, $height, $weight, $image, $description)) {
            echo json_encode(array('message' => 'Product create successfully'));
        } else {
            echo json_encode(array('message' => 'Có lỗi xảy ra khi thêm sản phẩm'));
        }
    } else {
        echo json_encode(array('message' => 'Vui lòng cung cấp đủ thông tin sản phẩm'));
    }
} else {
    echo json_encode(array('message' => 'Phương thức yêu cầu không hợp lệ'));
}

?>