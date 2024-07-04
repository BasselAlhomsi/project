<?php
namespace app\controllers;

require __DIR__.'/../models/UserModel.php';
use app\models\UserModel;


class UserController {
    private $model;
  

    public function __construct($db) 
    {
      
        $this->model = new UserModel($db);
    }
   
    
    public function index() {
        $users = $this->model->getUsers();
        // var_dump('gg');
        echo json_encode($users);
        require __DIR__.'/../../resource/views/user_list.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = [
                'username' => $username,
                'password' => $password,
            ];

            if ($this->model->addUser($data)) {
                header('Location:' . BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add user.";
            }
        }
    }

    public function showUsers() {
        $users = $this->model->getUsers();
        include __DIR__.'/../../resource/views/user_list.php';
    }

    public function deleteUser($id) {
        if ($this->model->deleteUser($id)) {
            echo "User deleted successfully!";
            echo json_encode($users);
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete user.";
        }
    }

    public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = [
                'username' => $username,
                'password' => $password,
            ];

            if ($this->model->updateUser($id, $data)) {
                echo "User updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update user.";
            }
        } else {
            $user = $this->model->getUserById($id);
            include __DIR__.'/../../resource/views/edit_user.php';
        }
    }

    public function editUser($id) {
        $user = $this->model->getUserById($id);
        include __DIR__.'/../../resource/views/edit_user.php';
    }

    public function searchUsers($searchTerm) {
        $users = $this->model->searchUsers($searchTerm);
        echo json_encode($users);
        //include __DIR__.'/../../resource/views/user_list.php';
    }

    public function showSearchedUsers($searchTerm) {
        $users = $this->model->searchUsers($searchTerm);
        include __DIR__.'/../../resource/views/user_list.php';
    }
}
