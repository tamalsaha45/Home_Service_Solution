<?php

global $routes;
require '../../routes.php';
require '../../Utils.php';

require_once __DIR__ . '/../../model/CustomerRepo.php';

session_start();

$Login_page = $routes['customer_login'];
$Dashboard_page = $routes['customer_dashboard'];

$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

//* Username Validation
    $username = $_POST['username'];
    if (empty($username)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo '<br>username Error 1<br>';
    } else {
        $everythingOK = TRUE;
    }

//* Password Validation
    $password = $_POST['password'];
    if (empty($password) || strlen($password) < 8) {
        // check if password size in 8 or more and check if it is empty
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Password must be at least 8 characters long.<br>';
    } else {
        $everythingOK = TRUE;
    }


    if ($everythingOK && $everythingOKCounter === 0) {
        echo 'Username = '.$username . '<br>';
        echo 'Password = '.$password . '<br>';
        $data = findCustomerByUsernameAndPassword($username, $password);

        echo '<br>Everything is ok<br>';
        echo '<br>ID found = '.isset($data["id"]).' <br>';
        if ($data && isset($data["id"])) {
            $_SESSION["data"] = $data;
            $_SESSION["user_id"] = $data["id"];

            if ($data['id'] > 0) {
                $_SESSION["defending_id"] = $data["id"];
                navigate($Dashboard_page);
                exit;
            } else {
                navigate($Login_page);
                exit;
            }
        } else {
            echo '<br>Returning to Login page because ID Password did not matched<br>';
            navigate($Login_page);
            exit;
        }
    } 

}


