<?php
//include_once '../../Navigation_Links.php';

session_start();

require_once __DIR__ . '/../../model/OrderRepo.php';
require_once __DIR__ . '/../../model/AppointmentRepo.php';
global $routes;
require '../../routes.php';


$Re_Schedulable_List = $routes['service_provider_re_schedule'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;

$order_id = $_POST['re_schedule_id'];
$date = $_POST['re_schedule_date'];

$decision = false;

echo '<br><h1> Received Order ID = '.$order_id.'</h1><br>';

try {
    $decision = updateAppointmentDate($date, $order_id, $user_id );
    if ($decision) {
        echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
        header("Location: {$Re_Schedulable_List}");
        exit;
    } else {
        header("Location: {$error_page_500}");
        exit;
    }
} catch (Exception $e) {
    header("Location: {$error_page_500}");
    exit;
}
