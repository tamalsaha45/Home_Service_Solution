<?php

global $routes;
require '../routes.php';
$root_page = $routes['customer_login'];

session_start();

session_start();
$_SESSION["data"] = null;
$_SESSION["data"]["status"] = -1;
$_SESSION["user_id"] = -1;
session_destroy();


header("Location: {$root_page}");