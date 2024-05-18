<?php
global $backend_routes;
session_start();
global $routes;
require '../../routes.php';
require '../../Utils.php';

include '../../model/OrderRepo.php';

global $image_routes;
$logo_image = $image_routes['logo_icon'];


$Dashboard = $routes['customer_dashboard'];
$Request_Service = $routes['customer_request'];
$Cancel_Order = $routes['customer_cancel_order'];
$Review =  $routes['customer_review_list'];
$Payment = '';


$Login_page = $routes['customer_login'];
$user_id = $_SESSION["user_id"];
$logoutController = $backend_routes['logout_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}


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

        <div class="division_a">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); grid-gap: 10px;">
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>AC Servicing</h4>
                    <p>BDT 2000/-</p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Home Cleaning</h4>
                    <p>BDT 1500/-</p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>Plumbing and Sanitary Services</h4>
                    <p>BDT 3000/-</p>
                </div>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; text-align: center;">
                    <h4>House Shifting Services</h4>
                    <p>BDT 5000/-</p>
                </div>
            </div>

            <div class="table-container" style="margin-top: 15px;">
                <h2>Previous Orders</h2>
                <table style="width: 100%; border-collapse: collapse; margin-left: 10px;">
                    <thead>
                    <tr style="background-color: #ddd; text-align: left; padding: 10px;">
                        <th>ID</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $rows = findAllOrderByCustomerID($user_id); // assuming $id is already defined
                    if($rows !== null){
                        foreach ($rows as $row) {
                            // Determine color classes based on availability and status
                            if($row['status'] !== 'Pending'){

                                $statusColor = '';
                                $statusColor = _Status_Badge_Color($row['status']);

                                // Generate table row
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td>{$row['type']}</td>";
                                echo "<td>{$row['address']}</td>";
                                echo "<td><span class='badge {$statusColor}'>{$row['status']}</span></td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>

                    </tbody>
                </table>
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
            <button onclick="goToRequestService()">Request Service</button>
            <button onclick="cancelOrder()">Cancel Order</button>
            <button onclick="leaveReview()">Review</button>
            <button onclick="logout()">Logout</button>
        </div>
    </div>
</div>

<script>
    function goToDashboard() {
        window.location.href = "<?php echo $Dashboard; ?>";
    }

    function goToRequestService() {
        window.location.href = "<?php echo $Request_Service; ?>";
    }

    function cancelOrder() {
        window.location.href = "<?php echo $Cancel_Order; ?>";
    }

    function leaveReview() {
        window.location.href = "<?php echo $Review; ?>";
    }

    function logout() {
        window.location.href = "<?php echo $logoutController; ?>";
    }
</script>

</body>
</html>

