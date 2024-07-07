<?php

namespace app\controllers;

require __DIR__.'/../models/AppointmentModel.php';
use app\models\AppointmentModel;


class AppointmentController{
    private $model;
  

    public function __construct($db) {
      
        $this->model = new AppointmentModel($db);
    }


    private function jeson($data)
    {
    header("Content_type:application/json");
     echo json_encode($data);
     exit;
    }
   

    public function index() {
        $Appointments= $this->model->getAppointment();
        // var_dump('gg');
       // include __DIR__.'/../views/user_list.php';
       $this->jeson($Appointments);
    }

    public function searchAppointments($searchTerm) {
        $Appointments= $this->model->searchAppointment($searchTerm);
        echo json_encode($Appointments);
       // include '../views/user_list.php';
       
    }

    public function addAppointment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Date = $_POST['Date'];        
            $Time = $_POST['Time'];
            $User_id= $_POST['User_id'];
            $Doctor_id = $_POST['Doctor_id'];
          //
          if(! $this->model->Appointmentexist($Date,$Time,$Doctor_id ))
            {
            $data = [
                'Date' => $Date,
                'Time' => $Time,
                'User_id' => $User_id,
                'Doctor_id' => $Doctor_id
            ];
            $this->model->addAppointment($data); 
            $this->jeson($data);   
            $this->index();
             }
    }
}

    public function showAppointments() {
        $Appointment = $this->model->getAppointment();
       // include '../views/user_list.php';
       echo json_encode($Appointment);

    }

 public function deleteAppointment($id) {
       if ($this->model->deleteAppointment($id)) {
          echo "User deleted successfully!";
         header('Location:' . BASE_PATH);
      } else {
          echo "Failed to delete user.";
        }
  }

    // public function updateUser($id) {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    //         $data = [
    //             'username' => $username,
    //             'password' => $password,
    //         ];

    //         if ($this->model->updateUser($id, $data)) {
    //             echo "User updated successfully!";
    //             header('Location:' . BASE_PATH);
    //         } else {
    //             echo "Failed to update user.";
    //         }
    //     } else {
    //         $user = $this->model->getUserById($id);
    //         include __DIR__.'/../views/edit_user.php';
    //     }
    // }

    // public function editUser($id) {
    //     $user = $this->model->getUserById($id);
    //     include __DIR__.'/../views/edit_user.php';
    // }

//   public function searchAppointments($searchTerm) {
//         $Appointments = $this->model->searchAppointments($searchTerm);
//         include '../views/user_list.php';
//    }

    // public function showSearchedUsers($searchTerm) {
    //     $users = $this->model->searchUsers($searchTerm);
    //     include '../views/user_list.php';
    // }

 
}
