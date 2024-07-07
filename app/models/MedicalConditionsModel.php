<?php
namespace app\models;

class MedicalConditionsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getMedicalConditions() {

        return $this->db->get('medical_conditions');
    }

    public function getMedicalConditionById($id) {
        return $this->db->where('Appointment_id', $id)->get('medical_conditions');
    }

    public function addMedicalCondition($data) {

        return $this->db->insert('medical_conditions', $data);

    }

    public function updateMedicalCondition($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('medical_conditions', $data);
    }

    public function deleteMedicalCondition($id) {
        $this->db->where('id', $id);
        return $this->db->delete('medical_conditions');
    }

    public function searchMedicalConditions($searchTerm) {
        $this->db->where('ConditionName',$searchTerm."%", 'Like');
        return $this->db->get('medical_conditions');
    }

}
