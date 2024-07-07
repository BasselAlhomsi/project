<?php
namespace app\controllers;

require __DIR__.'/../models/RatingModel.php';
use app\models\RatingModel;
use app\models\DoctorModel;

class RatingController {
    private $model,$modell;

    

    public function __construct($db) 
    {
      
        $this->model = new RatingModel($db);
        $this->modell = new DoctorModel($db);
    }
   
    
    public function index() {
        $ratings = $this->model->getRatings();
        echo json_encode($ratings);
        //require __DIR__.'/../../resource/views/user_list.php';
    }

    public function addRating() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Rating = $_POST['Rating'];
            $Comments = $_POST['Comments'];
            $User_id = $_POST['User_id'];
            $Doctor_id = $_POST['Doctor_id'];
            $data = [
                'Rating' => $Rating,
                'Comments' => $Comments,
                'User_id' => $User_id ,
                'Doctor_id' => $Doctor_id
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
                $result=$this->model->getRatings();
                foreach($result as $ele =>$v)
                {
                    if($data['Doctor_id']==$v['Doctor_id']&&($data['User_id']==$v['User_id']))
                    {
                            $insert = false;
                            break;
                    }          
                }
            }
            if($insert)
            {
                if ($this->model->addRating($data))
                {
                    //header('Location:' . BASE_PATH);
                    echo 'done' ;
                    $ratings = $this->model->getRatings();
                    echo json_encode($ratings);
                }
                else
                {
                    $ratings = $this->model->getRatings();
                    echo json_encode($ratings);
                    echo "Failed to add rating.";
                }
            }
            else
            {
                $ratings = $this->model->getRatings();
                echo json_encode($ratings);
                echo "Failed to add complete data.";
            }
        }
    }
    public function showRatings() 
    {
        $data=[];
        $average=[];
        $ratings=$this->model->getRatings();
        //echo count($ratings);
        foreach($ratings as $ele => $v)
        {
            if(!in_array($v["Doctor_id"],$data))
            {
                $sum=0;
                $x=$this->model->getRatingById($v["Doctor_id"]);
                foreach($x as $y =>$j)
                {
                    $sum+=$j["Rating"];
                }
                $avg=$sum/count($x);
                array_push($data,$v["Doctor_id"]);
                $average[$v["Doctor_id"]]=$avg;
            }
        }
        echo json_encode($ratings)." ".json_encode($average);
    }
        //include __DIR__.'/../../resource/views/user_list.php';

    public function deleteRating($id) {
        if ($this->model->deleteRating($id)) {
            $ratings = $this->model->getRatings();
            echo "Rating deleted successfully!";
            echo json_encode($ratings);
            //header('Location:' . BASE_PATH.);
        } else {
            echo "Failed to delete rating.";
        }
    }
    
    public function updateRating($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Rating = $_POST['Rating'];
            $Comments = $_POST['Comments'];
            $User_id = $_POST['User_id'];
            $Doctor_id = $_POST['Doctor_id'];
            $data = [
                'Rating' => $Rating,
                'Comments' => $Comments,
                'User_id' => $User_id ,
                'Doctor_id' => $Doctor_id
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
                $update=false;
                $result=$this->model->getRatings();
                foreach($result as $ele =>$v)
                {
                    if(($id==$v['id'])&&$data['Doctor_id']==$v['Doctor_id']&&($data['User_id']==$v['User_id']))
                    {
                            $update = true;
                            break;
                    }          
                }
            }
            if($update)
            {
                if ($this->model->updateRating($id, $data))
                {
                    echo "Rating updated successfully!";
                    $ratings = $this->model->getRatings();
                    echo json_encode($ratings);
                    //header('Location:' . BASE_PATH);
                }
            } 
            else
            {
                $ratings = $this->model->getRatingById($id);
                echo json_encode($ratings);
                //include __DIR__.'/../../resource/views/edit_user.php';
            }
        }
    }
    /*public function edit($id) {
        $user = $this->model->getUserById($id);
        include __DIR__.'/../../resource/views/edit_user.php';
    }
    */
    public function searchRatings($searchTerm) {
        $ratings = $this->model->searchRatings($searchTerm);
        echo json_encode($ratings);
        //include __DIR__.'/../../resource/views/user_list.php';
    }

}
