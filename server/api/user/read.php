<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/ConnectDb.php';
include_once '../../models/UserModel.php';

$database = new Database();
$db = $database->getConnection();

$user = new UserModel($db);

$result = $user->readAll();

$num = $result->rowCount();

if ($num > 0) {

    $users_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array(
            'userId' => $userid,
            'username' => $username,
            'password' => $password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
        );
        array_push($users_arr, $user_item);
    }

    echo json_encode($users_arr);

} else {
    echo json_encode(
        array('message' => "Not found")
    );
}
?>