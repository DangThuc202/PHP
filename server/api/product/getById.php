<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/ProductModel.php';

$database = new Database();
$db = $database->getConnection();

$product = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $productInfo = $product->getProductById($productId);

        if ($productInfo) {
            echo json_encode($productInfo);
        } else {
            echo json_encode(array('message' => 'Không tìm thấy sản phẩm với ID được cung cấp'));
        }
    } else {
        echo json_encode(array('message' => 'Vui lòng cung cấp ID của sản phẩm'));
    }
} else {
    echo json_encode(array('message' => 'Phương thức yêu cầu không hợp lệ'));
}

?>