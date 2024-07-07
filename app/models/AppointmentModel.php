<?php
namespace app\models;

class AppointmentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAppointment() {
        return $this->db->get('appointments');
    }   

    public function addAppointment($data) {
        return $this->db->insert('appointments', $data);
    }

    public function getAppointmentById($id) {
        return $this->db->where('id', $id)->getOne('appointments');
    }

    public function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);
    }

    public function deleteAppointment($id) {
        $this->db->where('id', $id);
        return $this->db->delete('appointments');
    }

    public function searchAppointment($searchTerm) {
        $this->db->where('Date', $searchTerm, 'LIKE');
        return $this->db->get('appointments');
    }
    public function Appointmentexist( $date,$time ,$doctor_id)
    {
       $v= $this->db->where('Date',  $date)->where('Time', $time )->where('doctor_id', $doctor_id )->get('Appointments');
        if( $this->db->count>0)
        return true;
    else return false;
    }
}
