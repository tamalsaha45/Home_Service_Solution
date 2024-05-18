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

$ReviewController = $backend_routes['review_controller'];

$user_id = $_SESSION["user_id"];

$Login_page = $routes['customer_login'];
$logoutController = $backend_routes['logout_controller'];

if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_id'])) {
    $order_id = $_POST['review_id'];

    $order_data = findOrderByID($order_id);

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
                <h2>Provide Review for <?php echo $order_data['type']?></h2>
                <form action="<?php echo $ReviewController; ?>" method="post" id="form" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="comment">Review:</label>
                        <input hidden type="number" id="order_id" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="text" id="comment" name="comment">
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select id="rating" name="rating">
                            <option value="null">Choose an option</option>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="2">★★</option>
                            <option value="1">★</option>
                        </select>

                    </div>

                    <button type="submit" class="login-btn">Send Review</button>
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
            <button onclick="goToRequestService()">Request Service</button>
            <button onclick="cancelOrder()">Cancel Order</button>
            <button style="background-color: #ffffcc" onclick="leaveReview()">Review</button>
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




