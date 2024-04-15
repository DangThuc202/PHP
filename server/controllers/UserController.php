<?php
class UserController
{
    public function index()
    {
        $database = new Database();
        $db = $database->getConnection();

        $product = new ProductModel($db);
        $stmt = $product->readAll();
    }
}