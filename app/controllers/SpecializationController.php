<?php
namespace app\controllers;

require __DIR__.'/../models/SpecializationModel.php';
use app\models\SpecializationModel;

class SpecializationController {
    private $model;
  

    public function __construct($db) 
    {
      
        $this->model = new SpecializationModel($db);
   
    }  
    
    public function index() {
        $sp= $this->model->getSpecializations();
        echo json_encode($sp);

    }

    public function addSpecialization() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Name= $_POST['Name'];
            $data = [
                'Name'=> $Name,
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
                $result=$this->model->getSpecializations();
                foreach($result as $ele =>$v)
                {
                    if($data['Name']==$v['Name'])
                    {
                            $insert = false;
                            break;
                    }          
                }
            }
            if($insert)
            {
                if ($this->model->addSpecialization($data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $Specializations = $this->model->getSpecializations();
                    echo json_encode($Specializations);
                }
                else
                {
                    $Specializations = $this->model->getSpecializations();
                    echo json_encode($Specializations);
                    echo "Failed to add Specialization.";
                }
            }
            else
            {
                $Specializations = $this->model->getSpecializations();
                echo json_encode($Specializations);
                echo "Failed to add complete data.";
            }
        }
    }

    public function showSpecializations() {
        $Specializations = $this->model->getSpecializations();
        echo json_encode($Specializations);
    }
    public function searchSpecializations($searchTerm) {
        $specializations = $this->model->searchSpecializations($searchTerm);
        echo json_encode($specializations);
        //include __DIR__.'/../../resource/views/user_list.php';
    }

}


