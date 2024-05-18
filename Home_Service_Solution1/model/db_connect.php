<?php
function db_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "home_service_solution";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    return $conn;
}
