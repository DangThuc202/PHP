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
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->username) && isset($data->password)) {
        $username = $data->username;
        $password = $data->password;
        $firstname = isset($data->firstname) ? $data->firstname : '';
        $lastname = isset($data->lastname) ? $data->lastname : '';
        $address = isset($data->address) ? $data->address : '';

        $existingUser = $user->getUserByUsername($username);

        if ($existingUser) {
            http_response_code(400); // Bad Request
            echo json_encode(array('message' => 'Username đã tồn tại, vui lòng chọn một username khác'));
        } else if ($user->register($username, $password, $firstname, $lastname, $address)) {
            http_response_code(201); // Created
            echo json_encode(array('message' => 'User registered successfully'));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'User registration failed'));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Username or password not provided'));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Invalid request method'));
}

?>