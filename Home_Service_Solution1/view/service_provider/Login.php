<?php

// Service Provider

global $routes, $backend_routes;
require '../../routes.php';


$loginController_file = $backend_routes['service_provider_login_controller'];
$service_provider_signup = $routes['service_provider_signup'];;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Service Solution - Login</title>
    <link rel="stylesheet" href="/Home_Service_Solution/css/Login.css">
</head>
<body>

<div class="login-container">
    <h2><center>Welcome back Service Provider! Please log in to continue</center></h2>
    <form action="<?php echo $loginController_file; ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
    </form>
    <a href="<?php echo  $service_provider_signup;?>" class="signup-link">Don't have an account? Signup</a>
</div>

<script src="js/index.js"></script>
</body>
</html>