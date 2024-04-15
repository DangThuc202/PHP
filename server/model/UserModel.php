<?php
class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM user";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($userData)
    {
        $username = $userData['username'];
        $password = $userData['password'];
        $firstName = $userData['firstName'];
        $lastName = $userData['lastName'];
        $address = $userData['address'];
        $isAdmin = $userData['isAdmin'];

        try {
            $query = "INSERT INTO user (username, password, firstName, lastName, address, isAdmin) 
                VALUES(:username, :password, :firstName, :lastName, :address, :isAdmin)";
            $statement = $this->conn->prepare($query);

            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':firstName', $firstName);
            $statement->bindParam(':lastName', $lastName);
            $statement->bindParam(':address', $address);
            $statement->bindParam(':isAdmin', $isAdmin);

            $statement->execute();

        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Lỗi thêm người dùng: " . $e->getMessage();
            return false; // hoặc throw một exception tùy thuộc vào cách xử lý lỗi của bạn
        }

    }

}

?>