<?php

// Define routes
$routes = [
    
    'login_decider' => '/Home_Service_Solution/view/Login_Decider.php',
    'signup_decider' => '/Home_Service_Solution/view/Signup_Decider.php',

    'customer_login' => '/Home_Service_Solution/view/customer/Login.php',
    'service_provider_login' => '/Home_Service_Solution/view/service_provider/Login.php',

    'customer_dashboard' => '/Home_Service_Solution/view/customer/Dashboard.php',
    'service_provider_dashboard' => '/Home_Service_Solution/view/service_provider/Dashboard.php',

    'customer_signup' => '/Home_Service_Solution/view/customer/Signup.php',
    'service_provider_signup' => '/Home_Service_Solution/view/service_provider/Signup.php',

//  Customer

    'customer_request' => '/Home_Service_Solution/view/customer/RequestService.php',
    'customer_cancel_order' => '/Home_Service_Solution/view/customer/Cancel_Order.php',
    'customer_review_form' => '/Home_Service_Solution/view/customer/Review.php',
    'customer_review_list' => '/Home_Service_Solution/view/customer/Review_List.php',

//    Service-Provider

    'service_provider_all_requests' => '/Home_Service_Solution/view/service_provider/All_Requests.php',
    'service_provider_re_schedule' => '/Home_Service_Solution/view/service_provider/Re_Schedule.php',
    'service_provider_re_schedule_form' => '/Home_Service_Solution/view/service_provider/Re_Schedule_Form.php',
    'service_provider_my_profile' => '/Home_Service_Solution/view/service_provider/My_Profile.php',

];

$backend_routes = [
    'customer_login_controller' => '/Home_Service_Solution/controller/customer/LoginController.php',
    'service_provider_login_controller' => '/Home_Service_Solution/controller/Service_provider/LoginController.php',

    'customer_signup_controller' => '/Home_Service_Solution/controller/customer/SignupController.php',
    'service_provider_signup_controller' => '/Home_Service_Solution/controller/Service_provider/SignupController.php',

    'logout_controller' => '/Home_Service_Solution/controller/LogoutController.php',

    'request_service_controller' => '/Home_Service_Solution/controller/customer/RequestServiceController.php',

//    Customer

    'customer_cancel_order_controller' => '/Home_Service_Solution/controller/customer/CancelOrderController.php',
    'review_controller' => '/Home_Service_Solution/controller/customer/ReviewController.php',

//    Service-Provider

    'service_provider_all_request_accept_controller' => '/Home_Service_Solution/controller/Service_provider/All_Request_AcceptController.php',
    'my_profile_controller' => '/Home_Service_Solution/controller/Service_provider/My_ProfileController.php',
    're_schedule_controller' => '/Home_Service_Solution/controller/Service_provider/Re_Schedule_Controller.php',



];


$image_routes = [
    'user_icon' => '/Home_Service_Solution/view/static/image/user.png',
    'customer_icon' => '/Home_Service_Solution/view/static/image/customer.png',
    'service_provider_icon' => '/Home_Service_Solution/view/static/image/service_provider.png',

    'logo_icon' => '/Home_Service_Solution/view/static/image/logo.png',
];

?>
