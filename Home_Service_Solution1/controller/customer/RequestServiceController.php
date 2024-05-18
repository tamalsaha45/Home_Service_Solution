<?php

// Customer

global $routes;
require '../../routes.php';
require '../../Utils.php';

require_once __DIR__ . '/../../model/OrderRepo.php';

session_start();

$Login_page = $routes['customer_login'];
$Cancel_order_page = $routes['customer_cancel_order'];

$user_id = $_SESSION["user_id"];

//echo $_SERVER['REQUEST_METHOD'];
$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

    $service = $_POST['service'];
    if (empty($service)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo '<br>Service Error 1<br>';
    } else {
        $everythingOK = TRUE;
    }

    $address = $_POST['address'];
    if (empty($address)) {
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Address Error 1.<br>';
    } else {
        $everythingOK = TRUE;
    }


    if ($everythingOK && $everythingOKCounter === 0) {
        echo 'Service Name = '.$service . '<br>';
        echo 'Address = '.$address . '<br>';

        $temp_user_id = $_SESSION["defending_id"];
        $data = createOrder($service, $address,"Pending", $temp_user_id);

//        echo '<br><br>';
        echo '<br>Everything is ok<br>';
        echo '<br>ID found = '.$data.' <br>';
        if ($data > 0) {

            if ($data > 0) {
                navigate($Cancel_order_page);
                exit;
            } else {
                navigate($Login_page);
                exit;
            }
        } else {
            echo '<br>Returning to Login page because Order Could not be placed<br>';
            navigate($Login_page);
            exit;
        }
    } else {
        echo '<br>Returning to Login page because The data user provided is not properly validated like 
                address and Service did not properly provided <br>';
        navigate($Login_page);
        exit;
    }


}


