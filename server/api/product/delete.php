<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/ProductModel.php';

$database = new Database();
$db = $database->getConnection();

$product = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $productId = $_DELETE['id'] ?? null;

    if ($productId) {
        // Thực hiện xóa sản phẩm
        $deleted = $product->deleteProduct($productId);

        if ($deleted) {
            echo json_encode(array('message' => 'Xóa sản phẩm thành công'));
        } else {
            echo json_encode(array('message' => 'Không thể xóa sản phẩm'));
        }
    } else {
        echo json_encode(array('message' => 'Vui lòng cung cấp ID của sản phẩm để xóa'));
    }
} else {
    echo json_encode(array('message' => 'Phương thức yêu cầu không hợp lệ'));
}

?>