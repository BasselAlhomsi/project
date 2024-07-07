<?php
namespace app\models;

class RatingModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRatings() {
        return $this->db->get('ratings');
    }

    public function addRating($data) {
        return $this->db->insert('ratings', $data);
    }

    public function getRatingById($id) {
        return $this->db->where('Doctor_id', $id)->get('ratings');
    }

    public function updateRating($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('ratings', $data);
    }

    public function deleteRating($id) {
        $this->db->where('id', $id);
        return $this->db->delete('ratings');
    }

    public function searchRatings($searchTerm) {
        $this->db->where('rating',$searchTerm."%", 'Like');
        return $this->db->get('ratings');
    }
}
