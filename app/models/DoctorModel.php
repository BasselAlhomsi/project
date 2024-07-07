<?php
namespace app\models;

class DoctorModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDoctors() {

        return $this->db->get('doctors');
    }

    public function addDoctor($data) {

        return $this->db->insert('doctors', $data);

    }

    public function getName($id) {
        return $this->db->where('Specialization_id',$id)->getValue('specializations','Name');
    }


    public function getDoctorById($id) {
        return $this->db->where('id', $id)->getOne('doctors');
    }


    public function searchDoctors($searchTerm) {
        $this->db->where('Phone',$searchTerm, '=');
        return $this->db->get('doctors');
    }

}
