<?php

namespace app\models;

class AppointmentModel {
    
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function checkUserExists($userId) {
        return $this->db->where('id', $userId)->getOne('users');
    }

    public function checkDoctorExists($doctorId) {
        return $this->db->where('id', $doctorId)->getOne('doctors');
    }

    public function addAppointment($Doctor_id,$User_id,$date_time,$clock,$Condition_id) {
        $data = array(
            'Doctor_id'=>$Doctor_id,
            'User_id' =>$User_id,
            'date_time'=>$date_time,
            'clock'=>$clock,
            'Condition_id'=>$Condition_id
        );
        return $this->db->insert('appointments', $data);
    }
    public function getAppointments() {
        return $this->db->get('appointments');
    }
    public function getAppointmentsByUserId($userId) {
        $appointments = $this->db->where('User_id', $userId)->get('appointments');
        return $appointments;
    }

    public function getAppointmentsByDoctorId($doctorId) {
        $appointments = $this->db->where('Doctor_id', $doctorId)->get('appointments');
        return $appointments;
    }
}
?>