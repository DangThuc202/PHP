<?php
class DefaultController
{
    private $db;
    private $productModel;
    private $userModel;

    function __construct()
    {
        $this->db = (new Database())->getConnection();
        // $this->productModel = new ProductModel($this->db);
        // $this->userModel = new UserModel($this->db);
    }

    function index()
    {
        // $products = $this->productModel->readAll();
        // // include_once 'app/views/share/index.php';
        // $users = $this->userModel->readAll();
        // // include_once 'app/views/share/index.php';
    }
}