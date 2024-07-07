<?php
namespace app\controllers;

require __DIR__.'/../models/MedicalConditionsModel.php';
use app\models\MedicalConditionsModel;

class MedicalConditionsController {
    private $model;
  

    public function __construct($db) 
    {
      
        $this->model = new MedicalConditionsModel($db);
   
 }
    
    public function index() {
        $MedicalCondition = $this->model->getMedicalConditions();
        echo json_encode($MedicalConditions);

    }

    public function addMedicalCondition() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ConditionName = $_POST['ConditionName'];
            $Test = $_POST['Test'];
            $Drugs = $_POST['Drugs'];
            $Appointment_id  = $_POST['Appointment_id'];
            $data = [
                'ConditionName'=> $ConditionName,
                'Test' => $Test,
                'Drugs' => $Drugs,
                'Appointment_id' => $Appointment_id,
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
                $result=$this->model->getMedicalConditions();
                foreach($result as $ele =>$v)
                {
                    if($data['Appointment_id']==$v['Appointment_id'])
                    {
                            $insert = false;
                            break;
                    }          
                }
            }
            if($insert)
            {
                if ($this->model->addMedicalCondition($data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $MedicalConditions = $this->model->getMedicalConditions();
                    echo json_encode($MedicalConditions);
                }
            }
            else
            {
                $MedicalConditions = $this->model->getMedicalConditions();
                echo json_encode($MedicalConditions);
                echo "Failed to add complete data.";
            }
        }
    }

    public function deleteMedicalCondition($id) {
        if ($this->model->deleteMedicalCondition($id)) {
            $MedicalConditions = $this->model->getMedicalConditions();
            echo "Medical_condition deleted successfully!";
            echo json_encode($MedicalConditions);
            //header('Location:' . BASE_PATH.);
        } else {
            echo "Failed to delete Medical_condition.";
        }
    }
    

    public function updateMedicalCondition($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ConditionName = $_POST['ConditionName'];
            $Test = $_POST['Test'];
            $Drugs = $_POST['Drugs'];
            $Appointment_id  = $_POST['Appointment_id'];
            $data = [
                'ConditionName'=> $ConditionName,
                'Test' => $Test,
                'Drugs' => $Drugs,
                'Appointment_id' => $Appointment_id
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
            $update=false;
            if (!$containsNullOrEmptyOrSpaces)
            {
                $result=$this->model->getMedicalConditions();
                foreach($result as $ele =>$v)
                {
                    if(($id==$v['id'])&&($data['Appointment_id']==$v['Appointment_id']))
                    {
                        $update = true;
                    }          
                }
            }
            if($update)
            {
                if ($this->model->updateMedicalCondition($id,$data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $MedicalConditions = $this->model->getMedicalConditions();
                    echo json_encode($MedicalConditions);
                }
            }
            else
            {
                echo "Failed to add complete data.";
            }
        }
    }
    public function showMedicalConditions() {
        $MedicalConditions = $this->model->getMedicalConditions();
        echo json_encode($MedicalConditions);        
    }
        
    public function searchMedicalConditions($searchTerm) {
        $MedicalConditions = $this->model->searchMedicalConditions($searchTerm);
        echo json_encode($MedicalConditions);
        //include __DIR__.'/../../resource/views/user_list.php';
    }

}

    
    

