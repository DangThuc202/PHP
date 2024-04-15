<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/UserModel.php';

$database = new Database();
$db = $database->getConnection();

$user = new UserModel($db);

$userId = isset($_GET['userId']) ? $_GET['userId'] : die();

$result = $user->getUserById($userId);

$num = $result->rowCount();

if ($num > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);

    $user_item = array(
        'userId' => $userid,
        'username' => $username,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'address' => $address,
    );

    echo json_encode($user_item);
} else {
    echo json_encode(array('message' => "User not found"));
}
?>