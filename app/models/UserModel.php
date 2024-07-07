<?php
namespace app\models;

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUsers() {
        return $this->db->get('ha');
    }

    public function addUser($data) {
        return $this->db->insert('ha', $data);
    }

    public function getUserById($id) {
        return $this->db->where('id', $id)->getOne('ha');
    }

    /*public function updateUser($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    */
    /*public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
    */
    public function searchUsers($searchTerm) {
        $this->db->where('Phone',$searchTerm, '=');
        return $this->db->get('users');
    }
}
