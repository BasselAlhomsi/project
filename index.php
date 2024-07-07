<?php

use app\controllers\AdminController;
use app\controllers\RatingController;
use app\controllers\DoctorController;
use app\controllers\UserController;
use app\controllers\AppointmentController;
use app\controllers\SpecializationController;
use app\controllers\MedicalConditionsController;

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/DB/MysqliDb.php';
require_once __DIR__ . '/app/controllers/AdminController.php';
require_once __DIR__ . '/app/controllers/RatingController.php';
require_once __DIR__ . '/app/controllers/DoctorController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/SpecializationController.php';
require_once __DIR__ . '/app/controllers/AppointmentController.php';
require_once __DIR__ . '/app/controllers/MedicalConditionsController.php';

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$request = $_SERVER['REQUEST_URI'];
 

define('BASE_PATH', '/');

$admin = new AdminController($db);
$rating = new RatingController($db);
$doctor = new DoctorController($db);
$user = new UserController($db);
$specialization = new SpecializationController($db);
$Appointment = new AppointmentController($db);
$Condition = new MedicalConditionsController($db);

switch ($request)
{
    case BASE_PATH :
        $admin->index();
        break;
    case BASE_PATH . 'rating/add':
        $rating->addRating();
        break;
    case BASE_PATH . 'rating/show':
        $rating->showRatings();
        break;
    case BASE_PATH . 'rating/delete?id=' . $_GET['id']:
        // var_dump($_GET['id']);
        $rating->deleteRating($_GET['id']);
        break;
    case BASE_PATH . 'rating/update?id=' . $_GET['id']:
        $rating->updateRating($_GET['id']);
        break;
    case BASE_PATH . 'rating/search':
        $rating->searchRatings($_POST['search_term']);
        break;
    case BASE_PATH . 'user/add':
        $user->addUser();
        break;
    case BASE_PATH . 'user/show':
        $user->showUsers();
        break;
    case BASE_PATH . 'user/delete?id=' . $_GET['id']:
        // var_dump($_GET['id']);
        $user->deleteUser($_GET['id']);
        break;
    case BASE_PATH . 'user/update?id=' . $_GET['id']:
        $user->updateUser($_GET['id']);
        break;
    /*case BASE_PATH . 'edit?id=' . $_GET['id']:
        // var_dump($_GET['id']);
        $controller->editUser($_GET['id']);
        break;
    */
    case BASE_PATH . 'user/search':
        $user->searchUsers($_POST['search_term']);
        break;
    /*case BASE_PATH . 'user/show_search':
        $rating->showSearchedUsers($_GET['search_term']);
        break;
    */
    case BASE_PATH . 'medicalcondition/add':
        $Condition ->addMedicalCondition();
        break;
    case BASE_PATH . 'medicalcondition/show':
        $Condition ->showMedicalConditions();
        break;
    case BASE_PATH . 'medicalcondition/delete?id=' . $_GET['id']:
        // var_dump($_GET['id']);
        $Condition ->deleteMedicalCondition($_GET['id']);
        break;
    case BASE_PATH . 'medicalcondition/update?id=' . $_GET['id']:
        $Condition ->updateMedicalCondition($_GET['id']);
        break;
    case BASE_PATH . 'medicalcondition/search':
        $Condition ->searchMedicalConditions($_POST['search_term']);
        break;
    case BASE_PATH . 'doctor/add':
        $doctor->addDoctor();
        break;
    case BASE_PATH . 'doctor/show':
        $doctor->showDoctors();
        break;
    case BASE_PATH . 'doctor/search':
        $doctor->searchDoctors($_POST['search_term']);
        break;
    case BASE_PATH . 'appointment/add':
        $Appointment->addAppointment();
        break;
    case BASE_PATH . 'appointment/show':
        $Appointment->showAppointments();
        break;
    case BASE_PATH . 'appointment/delete?id=' . $_GET['id']:
        // var_dump($_GET['id']);
        $Appointment->deleteAppointment($_GET['id']);
        break;
    /*case BASE_PATH . 'appointment/update?id=' . $_GET['id']:
        $Appointment->updateAppointment($_GET['id']);
        break;
    */
    case BASE_PATH . 'appointment/search':
        $Appointment->searchAppointments($_POST['search_term']);
        break;
    /*case BASE_PATH . 'appointment/show_search':
        $rating->showSearchedAppointments($_GET['search_term']);
        break;
    */ 
    case BASE_PATH . 'specialization/add':
        $specialization ->addSpecialization();
        break;
    case BASE_PATH . 'specialization/show':
        $specialization ->showSpecializations();
        break;
    case BASE_PATH . 'specialization/search':
        $specialization ->searchSpecializations($_POST['search_term']);
        break;
    default;
    break;               
}
