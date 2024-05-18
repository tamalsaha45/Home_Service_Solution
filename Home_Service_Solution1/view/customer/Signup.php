<?php

// Customer

global $routes, $backend_routes;
require '../../routes.php';

$Signup_Controller_File = $backend_routes['customer_signup_controller'];
$customer_login = $routes['customer_login'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Service Solution - Signup</title>
    <link rel="stylesheet" href="/Home_Service_Solution/css/Login.css">

</head>
<body>

<div class="login-container">
    <h2>Customer Signup</h2>
    <form action="<?php echo $Signup_Controller_File; ?>" method="post" id="form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
        </div>
        <button type="submit" class="login-btn">Signup</button>
    </form>
    <a href="<?php echo  $customer_login; ?>" class="signup-link">Already have an account? Login</a>
</div>

</body>
</html>