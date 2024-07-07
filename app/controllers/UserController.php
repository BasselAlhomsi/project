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
      //  require __DIR__.'/../../resource/views/user_list.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Name = $_POST['Name'];
           $Age = $_POST['Age'];
            $Gender= $_POST['Gender'];
            $Phone = $_POST['Phone'];
          
            $data = [
                'Name' => $Name,
                'Age'=>$Age,
                'Gender'=>$Gender,
                'Phone'=>$Phone
            ];
            $containsNullOrEmptyOrSpaces = false;
            foreach ($data as $element => $i)
            {
                if (is_null($i) ||trim($i)==="") 
                {
                    $containsNullOrEmptyOrSpaces=true;
                    break;
                }
            }
            if (!$containsNullOrEmptyOrSpaces)
            {
                $insert=true;
                $result=$this->model->getUsers();
                foreach($result as $ele =>$v)
                {
                    if($data['Phone']==$v['Phone'])
                    {
                            $insert = false;
                            break;
                    }          
                }
            }
            if($insert)
            {
                if ($this->model->addUser($data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $users = $this->model->getUsers();
                    echo json_encode($users);
                }
            }
            else
            {
                $users = $this->model->getUsers();
                echo json_encode($users);
                echo "Failed to add complete data.";
            }
        }
    }

    public function showUsers() {
        $users = $this->model->getUsers();
       // include __DIR__.'/../../resource/views/user_list.php';
       echo json_encode($users);
    }

    /*public function deleteUser($id) {
        if ($this->model->deleteUser($id)) {
            echo "User deleted successfully!";
          //  echo json_encode($this->model->getUsers());
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete user.";
        }
    }
    */
    /*public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Name = $_POST['Name'];
            $Age = $_POST['Age'];
            $Gender= $_POST['Gender'];
            $Phone = $_POST['Phone'];
            $data = [
                'Name' => $Name,
               // 'Age '=>$Age,
                'Gender'=>$Gender,
                'Phone'=>$Phone,
            ];

            if ($this->model->updateUser($id, $data)) {
                echo "User updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update user.";
            }
        } else {
            $users = $this->model->getUserById($id);
           // include __DIR__.'/../../resource/views/edit_user.php';
           echo json_encode($users);
        }
    }
    */
    /*public function editUser($id) {
        $user = $this->model->getUserById($id);
       // include __DIR__.'/../../resource/views/edit_user.php';
       echo json_encode($user);
    }
    */
    public function searchUsers($searchTerm) {
        $users = $this->model->searchUsers($searchTerm);
        echo json_encode($users);
        //include __DIR__.'/../../resource/views/user_list.php';
    }
}
