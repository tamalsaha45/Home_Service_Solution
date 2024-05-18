<?php
global $backend_routes;
session_start();
global $routes;
require '../../routes.php';
require '../../Utils.php';

include '../../model/OrderRepo.php';

global $image_routes;
$logo_image = $image_routes['logo_icon'];


$Dashboard = $routes['service_provider_dashboard'];
$All_Requests = $routes['service_provider_all_requests'];
$Re_Schedule = $routes['service_provider_re_schedule'];
$My_Profile =  $routes['service_provider_my_profile'];


$Login_page = $routes['service_provider_login'];
$user_id = $_SESSION["user_id"];
$logoutController = $backend_routes['logout_controller'];
$Accept_Request_Controller = $backend_routes['service_provider_all_request_accept_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}

$TotalRequestCompleted = '';
$TotalIncome = '';
$AccountMode = '';
$UpcomingNextAppointment = '';


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


        <div class="table-container" style="margin-top: 15px;">
            <h2>Current Orders</h2>
            <table style="width: 100%; border-collapse: collapse; margin-left: 10px;">
                <thead>
                <tr style="background-color: #ddd; text-align: left; padding: 10px;">
                    <th>ID</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php

                $rows = findAllOrders(); // assuming $id is already defined
                if($rows !== null){
                    foreach ($rows as $row) {
                        // Determine color classes based on availability and status
                        if($row['status'] === 'Pending'){

                            $statusColor = '';
                            $statusColor = _Status_Badge_Color($row['status']);

                            // Generate table row
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['type']}</td>";
                            echo "<td>{$row['address']}</td>";
                            echo "<td><span class='badge {$statusColor}'>{$row['status']}</span></td>";
                            echo '<td>';
                            echo "<form action='$Accept_Request_Controller' method='post' style='display: inline-block;'>
                                    <input hidden type='number' id='cancel_id' name='accept_id' value='{$row['id']}' />
                                    <button type='submit' class='badge badge-success' data-id='{$row['id']}'>Accept</button>
                                          </form>
                                          ";
                            echo '</td>';
                            echo "</tr>";
                        }
                    }
                }
                ?>

                </tbody>
            </table>
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
            <button onclick="goToDashboard()">Dashboard</button>
            <button style="background-color: #ffffcc" onclick="goToAllRequests()">Requests</button>
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

