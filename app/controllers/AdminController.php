<?php
namespace app\controllers;

require __DIR__.'/../models/AdminModel.php';

use app\models\AdminModel;
use app\models\DoctorModel;
use app\models\SpecializationModel;

class AdminController {

    private $model;
    private $modell;
    private $modelll;
    public function __construct($db) 
    {
      $this->model = new AdminModel($db);
      $this->modell = new DoctorModel($db);
      $this->modelll = new SpecializationModel($db);
    }
   
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Email = $_POST['Email'];
            $Password= $_POST['Password'];
           $data=[];
            if($this->model->getAdmin($Email,$Password))
            {
                $doctors=$this->modell->getDoctors();
                foreach($doctors as $ele => $v)
                {
                    echo $v["Name"]." ";
                }
            }
            else{
                echo "invalid data";
            }
        }
    }
}
