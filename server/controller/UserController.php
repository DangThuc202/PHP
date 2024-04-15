<?php
require_once '../model/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function getAllUsers()
    {
        $users = $this->userModel->getAllUsers();
        return $users;
    }

    public function addUser($userData)
    {
        // Gọi phương thức addUser từ UserModel
        $userAdded = $this->userModel->addUser($userData);

        if ($userAdded) {
            echo "Người dùng đã được thêm thành công!";
        } else {
            echo "Có lỗi xảy ra khi thêm người dùng!";
        }
    }

}
?>