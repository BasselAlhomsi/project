<?php
namespace app\controllers;

use app\models\AppointmentModel;

class AppointmentController {
    private $appointmentModel;

    public function __construct($db) {
        $this->appointmentModel = new AppointmentModel($db);
    }
    private function JsonResponse($data)
    {
     header("content-Type:application/json");
     echo json_encode($data);
     exit;
    }
    public function addAppointment($Doctor_id, $User_id, $date_time, $clock, $Condition_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
        if ($this->appointmentModel->checkUserExists($User_id) && $this->appointmentModel->checkDoctorExists($Doctor_id))
         {
            $result = $this->appointmentModel->addAppointment($Doctor_id, $User_id, $date_time, $clock, $Condition_id);
            if ($result) {
                $this->JsonResponse(["message"->"Appointment added successfully."]);
            } else
             {
                return $this->JsonResponse(['error' => 'Failed to add appointment']);
            }
        } 
        else
         {
            
            return $this->JsonResponse(['error' => 'User or doctor does not exist. Cannot add appointment.']);
        }
    }
    }
    public function getAppointments() {
        $appointments = $this->appointmentModel->getAppointments();
        return $this->JsonResponse($appointments);
    }

    public function getAppointmentsByUserId($userId) {
        $appointments = $this->appointmentModel->getAppointmentsByUserId($userId);
        return $this->JsonResponse($appointments);
    }

    public function getAppointmentsByDoctorId($doctorId) {
        $appointments = $this->appointmentModel->getAppointmentsByDoctorId($doctorId);
        return $this->JsonResponse($appointments);
    }
}
?>