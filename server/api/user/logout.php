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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();

    echo json_encode(array('message' => 'Đăng xuất thành công'));
}

function logout()
{
    session_destroy();
}

?>