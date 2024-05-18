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

$Request_ServiceController = $backend_routes['request_service_controller'];

$user_id = $_SESSION["user_id"];

$Login_page = $routes['customer_login'];
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
    <link rel="stylesheet" href="/Home_Service_Solution/css/Request_Service.css">

</head>
<body>

<div class="main_container">
    <div class="division_a">

        <div class="division_a">

            <div class="service-container">
                <h2>Place your order to get services</h2>
                <form action="<?php echo $Request_ServiceController; ?>" method="post" id="form">
                    <div class="form-group">
                        <label for="service">Select Service:</label>
                        <select id="service" name="service">
                            <option value="null">Choose an option</option>
                            <option value="AC Servicing">AC Servicing</option>
                            <option value="Home Cleaning">Home Cleaning</option>
                            <option value="Plumbing and Sanitation">Plumbing and Sanitary Services</option>
                            <option value="House Shifting">House Shifting Services</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <button type="submit" class="login-btn">Place Order</button>
                </form>
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
            <button onclick="goToDashboard()">Dashboard</button>
            <button style="background-color: #ffffcc" onclick="goToRequestService()">Request Service</button>
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
