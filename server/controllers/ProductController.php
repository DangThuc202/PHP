<?php
class ProductController
{
    public function index()
    {
        $database = new Database();
        $db = $database->getConnection();

        $product = new ProductModel($db);
        $stmt = $product->readAll();

        // include_once 'app/views/product_list.php';
    }
    function createProduct()
    {
        include_once 'app/views/product/add.php';
    }
    function deleteProduct()
    {
        include_once 'app/views/product/add.php';
    }
    function updateProduct()
    {
        include_once 'app/views/product/add.php';
    }
    function readProduct()
    {
        include_once 'app/views/product/add.php';
    }
    function getProductById()
    {
        include_once 'app/views/product/add.php';
    }
    function filterProductByName()
    {
        include_once 'app/views/product/add.php';
    }
    function filterProductByOrigin()
    {
        include_once 'app/views/product/add.php';
    }
    function filterProductByPrice()
    {
        include_once 'app/views/product/add.php';
    }
    function filterProductByColor()
    {
        include_once 'app/views/product/add.php';
    }
}