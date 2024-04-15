<?php
class ProductModel
{
    public $conn;
    private $table_name = "products";

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    function readAll()
    {
        $query = "SELECT productid, name, origin, price, color, width, height, weight, image, description FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function addProduct($name, $origin, $price, $color, $width, $height, $weight, $image, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name = :name, 
                      origin = :origin, 
                      price = :price, 
                      color = :color, 
                      width = :width, 
                      height = :height, 
                      weight = :weight, 
                      image = :image, 
                      description = :description";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function getProductById($productId)
    {
        $query = "SELECT productid, name, origin, price, color, width, height, weight, image, description 
              FROM " . $this->table_name . " 
              WHERE productid = :productid";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':productid', $productId);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($productId)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE productid = :productid";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':productid', $productId);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



}