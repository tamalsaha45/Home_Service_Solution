<?php
global $backend_routes;
session_start();
global $routes;
require '../../routes.php';
require '../../Utils.php';


include '../../model/ServiceProviderRepo.php';
include '../../model/OrderRepo.php';
include '../../model/AppointmentRepo.php';

global $image_routes;
$logo_image = $image_routes['logo_icon'];


$Dashboard = $routes['service_provider_dashboard'];
$All_Requests = $routes['service_provider_all_requests'];
$Re_Schedule = $routes['service_provider_re_schedule'];
$My_Profile =  $routes['service_provider_my_profile'];


$Login_page = $routes['service_provider_login'];
$user_id = $_SESSION["user_id"];
$logoutController = $backend_routes['logout_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}

$TotalRequestCompleted = -1;
$TotalIncome = -1;
$AccountMode = '';
$UpcomingNextAppointment = '';


// Find Total Requested Completed

$data = findAllOrderByServiceProviderID($user_id);
$user_data = findServiceProviderByID($user_id);
$appointment_data = findAllAppointmentsByServiceProviderID($user_id);

$TotalRequestCompleted = countAcceptedOrders($data);
$TotalIncome = calculateTotalIncome($data);
$AccountMode = $user_data['profile_mode'];
$UpcomingNextAppointment = getUpcomingAppointment($appointment_data);


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Service Solution -> Customer Dashboard</title>
    <link rel="stylesheet" href="/Home_Service_Solution/css/Customer_Dashboard.css">
</head>
<body>
<div class="main_container">
    <div class="division_a">

        <div class="division_a" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); grid-gap: 10px;">
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Total Request Completed</h4>
                    <hr>
                    <p style="font-weight: bolder; font-size: xx-large;"><?php  echo $TotalRequestCompleted; ?></p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Total Income</h4>
                    <hr>
                    <p style="font-weight: bolder; font-size: xx-large;"><?php  echo $TotalIncome; ?></p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Upcoming Next Appointment</h4>
                    <hr>
                    <p style="font-weight: bolder; font-size: xx-large;"><?php  echo $UpcomingNextAppointment; ?></p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Account Mode</h4>
                    <hr>
                    <p style="font-weight: bolder; font-size: xx-large;"><?php  echo $AccountMode; ?></p>
                </div>
            </div>
        </div>


    </div>
    <div class="division_b">
        <header class="navbar">
            <div class="logo">
                <img src="/Home_Service_Solution/view/static/image/1hss.png" style="border-radius: 50%;" alt="Logo">
            </div>
        </header>

    </div>
    <div class="division_d">
        <div class="left_panel">
            <button style="background-color: #ffffcc" onclick="goToDashboard()">Dashboard</button>
            <button onclick="goToAllRequests()">Requests</button>
            <button onclick="logout()">Logout</button>
        </div>
    </div>
</div>

<script>
    function goToDashboard() {
        window.location.href = "<?php echo $Dashboard; ?>";
    }

    function goToAllRequests() {
        window.location.href = "<?php echo $All_Requests; ?>";
    }

    function logout() {
        window.location.href = "<?php echo $logoutController; ?>";
    }
</script>

</body>
</html>

