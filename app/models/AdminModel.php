<?php

namespace app\models;

class AdminModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // public function getAdmin() {
    //     return $this->db->get('users');
    // }
    public function getAdmin($email,$password) {
       $admin=$this->db->where('email', $email)->where('password', $password)->getOne('admins');
       if( $this->db->count>0)
       {return true;} 
     else{return false;} 
    }


}
