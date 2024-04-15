<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/UserModel.php';

$database = new Database();
$db = $database->getConnection();

$user = new UserModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_body = file_get_contents('php://input');
    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

    if (stripos($content_type, 'application/json') !== false) {
        $data = json_decode($request_body);
        $username = $data->username ?? null;
        $password = $data->password ?? null;
    } elseif (stripos($content_type, 'application/x-www-form-urlencoded') !== false) {
        parse_str($request_body, $data);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
    } else {
        echo json_encode(array('message' => 'Loại dữ liệu không được hỗ trợ'));
        exit;
    }

    if ($username !== null && $password !== null) {
        $userInfo = $user->login($username, $password);

        if ($userInfo) {
            echo json_encode(array('message' => 'Thông tin đăng nhập chính xác', 'userInfo' => $userInfo));
        } else {
            echo json_encode(array('message' => 'Thông tin đăng nhập không chính xác'));
        }
    } else {
        echo json_encode(array('message' => 'Vui lòng cung cấp đầy đủ thông tin đăng nhập'));
    }
}
?>