<?php

session_start();

require_once __DIR__ . '/../../model/OrderRepo.php';
global $routes;
require '../../routes.php';


$All_Request_List_Page = $routes['service_provider_all_requests'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;

$order_id = $_POST['accept_id'];

$decision = false;

echo '<br><h1> Received Accept ID = '.$order_id.'</h1><br>';

try {
    $decision = updateOrderStatusWithServiceProvider( 'Accepted', $user_id, $order_id);
    if ($decision) {
        echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
        header("Location: {$All_Request_List_Page}");
        exit;
    } else {
        header("Location: {$error_page_500}");
        exit;
    }
} catch (Exception $e) {
    header("Location: {$error_page_500}");
    exit;
}
