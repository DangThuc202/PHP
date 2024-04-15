<?php
class UserModel
{
    public $conn;
    private $table_name = "users";

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    function readAll()
    {
        $query = "SELECT userid, username, password, firstname, lastname, address FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function register($username, $password, $firstname, $lastname, $address)
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, firstname, lastname, address) VALUES (:username, :password, :firstname, :lastname, :address)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function getUserByUsername($username)
    {
        $query = "SELECT firstname, lastname FROM " . $this->table_name . " WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['firstname'] . ' ' . $row['lastname'];
        } else {
            return false;
        }
    }


    function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username AND password = :password";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }



    function getUserById($userId)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE userId = :userId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }


}