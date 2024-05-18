<?php

session_start();

require_once __DIR__ . '/../../model/ReviewRepo.php';
global $routes;
require '../../routes.php';
require '../../Utils.php';


$Customer_review_list = $routes['customer_review_list'];
$Customer_review_form = $routes['customer_review_form'];
$error_page_500 = $routes['500_error'];

$user_id = $_SESSION['user_id'];

$everythingOK = FALSE;
$everythingOKCounter = 0;

$order_id = $_POST['order_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

echo 'Got Rating = '. $rating . '<br>';
echo 'Got Order ID = ' . $order_id . '<br>';
echo 'Got Comment = ' . $comment. '<br>';
echo 'Got User ID = ' .$user_id . '<br>';

$decision = false;


try {
    $decision = createReview($rating, $comment, $order_id, $user_id );
    if ($decision) {
        echo '<br><h1> Decision Update = '.$decision.'</h1><br>';
        navigate($Customer_review_list);
        exit;
    } else {
        navigate($Customer_review_form);
        exit;
    }
} catch (Exception $e) {
    navigate($Customer_review_form);
    exit;
}
