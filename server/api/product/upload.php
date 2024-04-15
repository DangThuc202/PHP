<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/ProductModel.php';

$database = new Database();
$db = $database->getConnection();

$productModel = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        echo ("a");
        $tempImagePath = $_FILES['image']['tmp_name'];

        $imageData = file_get_contents($tempImagePath);

        if ($imageData !== false) {
            try {
                $query = "UPDATE " . $this->$productModel . " SET image = :image WHERE productId = :productId";
                $stmt = $this->conn->prepare($query);

                // Bind tham số
                $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
                $stmt->bindParam(':productId', $productId);

                // Thực thi truy vấn
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
} else {
    return false;
}
?>