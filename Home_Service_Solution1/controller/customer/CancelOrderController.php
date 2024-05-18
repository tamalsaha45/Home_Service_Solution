<?php

session_start();

require_once __DIR__ . '/../../model/OrderRepo.php';
global $routes;
require '../../routes.php';


$Cancel_order_List_page = $routes['customer_cancel_order'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$order_id = $_POST['cancel_id'];

$decision = false;

echo '<br><h1> Received Cancel ID = '.$order_id.'</h1><br>';

try {
    $decision = updateOrderStatus( 'Cancelled',$order_id);
    if ($decision) {
        echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
        header("Location: {$Cancel_order_List_page}");
        exit;
    } else {
        header("Location: {$error_page_500}");
        exit;
    }
} catch (Exception $e) {
    header("Location: {$error_page_500}");
    exit;
}
