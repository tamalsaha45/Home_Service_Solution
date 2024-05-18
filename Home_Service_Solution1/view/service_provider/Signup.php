<?php

// Service Provider

global $routes, $backend_routes;
require '../../routes.php';

$Signup_Controller_File = $backend_routes['service_provider_signup_controller'];
$service_provider_login = $routes['service_provider_login'];

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
    <h2>Service Provider Signup</h2>
    <form action="<?php echo $Signup_Controller_File; ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="login-btn">Signup</button>
    </form>
    <a href="<?php echo  $service_provider_login; ?>" class="signup-link">Already have an account? Login</a>
</div>

</body>
</html>