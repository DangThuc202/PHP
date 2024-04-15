<?php
$servername = "localhost";
$username = "root";
$password = "";

require_once ("../controller/UserController.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=php", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $controller = new UserController($conn);
    $users = $controller->getAllUsers();
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>