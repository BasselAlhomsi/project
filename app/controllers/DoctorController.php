<?php
namespace app\controllers;

require __DIR__.'/../models/DoctorModel.php';
use app\models\DoctorModel;

class DoctorController {
    private $model;
  

    public function __construct($db) 
    {
      
        $this->model = new DoctorModel($db);
   
 }
    
    public function index() {
        $doctors = $this->model->getDoctors();
        echo json_encode($doctors);

    }

    public function addDoctor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Name= $_POST['Name'];
            $Age= $_POST['Age'];
            $Phone= $_POST['Phone'];
            $Specialization_id= $_POST['Specialization_id'];
            $data = [
                'Name'=> $Name,
                'Age' => $Age,
                'Phone' => $Phone,
                'Specialization_id' => $Specialization_id,
            ];
            $containsNullOrEmptyOrSpaces = false;
            foreach ($data as $element => $i)
            {
                if (is_null($i) ||trim($i)==="") 
                {
                    $containsNullOrEmptyOrSpaces=true;
                    break;
                }
            }
            if (!$containsNullOrEmptyOrSpaces)
            {
                $insert=true;
                $result=$this->model->getDoctors();
                foreach($result as $ele =>$v)
                {
                    if($data['Phone']==$v['Phone'])
                    {
                            $insert = false;
                            break;
                    }          
                }
            }
            if($insert)
            {
                if ($this->model->addDoctor($data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $doctors = $this->model->getDoctors();
                    echo json_encode($doctors);
                }
            }
            else
            {
                $doctors = $this->model->getDoctors();
                echo json_encode($doctors);
                echo "Failed to add complete data.";
            }
        }
    }
    public function showDoctors() {
        $doctors = $this->model->getDoctors();
        echo json_encode($doctors);        
    }
        
    public function searchDoctors($searchTerm) {
        $doctors = $this->model->searchDoctors($searchTerm);
        echo json_encode($doctors);
        //include __DIR__.'/../../resource/views/user_list.php';
    }

}

    
    

