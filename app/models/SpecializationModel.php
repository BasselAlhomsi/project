<?php
namespace app\models;

class specializationModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getSpecializations() {

        return $this->db->get('specializations');
    }

    public function addSpecialization($data) {

        return $this->db->insert('specializations', $data);

    }

    public function searchSpecializations($searchTerm) {
        $this->db->where('Name',$searchTerm."%", 'LIKE');
        return $this->db->get('specializations');
    }

}
