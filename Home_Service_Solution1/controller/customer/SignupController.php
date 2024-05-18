<?php

// Customer

global $routes;
require '../../routes.php';
require '../../Utils.php';

require_once __DIR__ . '/../../model/CustomerRepo.php';

session_start();


$Login_page = $routes['customer_login'];
$Signup_Page = $routes['customer_signup'];

$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

    $username = $_POST['username'];
    if (empty($username)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo '<br>username Error 1<br>';
    } else {
        $everythingOK = TRUE;
    }

    $password = $_POST['password'];
    if (empty($password) || strlen($password) < 8) {
        // check if password size in 8 or more and check if it is empty
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Password must be at least 8 characters long.<br>';
    } else {
        $everythingOK = TRUE;
    }


    $name = $_POST['name'];
    if (empty($name)) {
        // check if password size in 8 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>name error 1<br>';
    } else {
        $everythingOK = TRUE;
    }

    $phone = $_POST['phone'];
    if (empty($phone) || strlen($phone) < 8) {
        // check if password size in 8 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Phone error 1<br>';
    }elseif(!ctype_digit($phone)){
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Phone error 2<br>';
    }
    else {
        $everythingOK = TRUE;
    }

    $address = $_POST['address'];
    if (empty($address) ) {
        // check if password size in 8 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Phone error 1<br>';
    }
    else {
        $everythingOK = TRUE;
    }


    if ($everythingOK && $everythingOKCounter === 0) {
        echo 'Username = '.$username . '<br>';
        echo 'Password = '.$password . '<br>';
        echo 'Name = '.$name . '<br>';
        echo 'Phone = '.$phone . '<br>';
        echo 'Address = '.$address . '<br>';
        $inserted_id = createCustomer($name, $phone, $address, $username, $password);

//        echo '<br><br>';
        echo '<br>Everything is ok<br>';
        echo '<br>ID found = '.$inserted_id.' <br>';
        if ($inserted_id && $inserted_id > 0) {
            $_SESSION["data"] = $inserted_id;
            $_SESSION["user_id"] =$inserted_id;

            if ($inserted_id > 0) {
                navigate($Login_page);
                exit;
            } else {
                navigate($Signup_Page);
                exit;
            }
        } else {
            echo '<br>Returning to Signup page because Account Could not be Created<br>';
            navigate($Signup_Page);
            exit;
        }
    } 

}


