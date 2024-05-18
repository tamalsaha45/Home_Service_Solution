<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllReviews()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `appointment`';

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'user' table.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function findAppointmentByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `appointment` WHERE `id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Check for an empty result set
        if (!$user) {
            throw new Exception("No user found with ID: " . $id);
        }

        // Close the statement
        $stmt->close();

        return $user;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function findAppointmentByOrderIDAndServiceProviderID($order_id, $service_provider_id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `appointment` WHERE `order_id` = ? AND `service_provider_id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind the parameters
        $stmt->bind_param("ii", $order_id, $service_provider_id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the appointment as an associative array
        $appointment = $result->fetch_assoc();

        // Check for an empty result set
        if (!$appointment) {
            throw new Exception("No appointment found with Order ID: " . $order_id . " and Service Provider ID: " . $service_provider_id);
        }

        // Close the statement
        $stmt->close();

        return $appointment;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function findAllAppointmentsByServiceProviderID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `appointment` WHERE `service_provider_id` = '.$id;

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'user' table.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function updateAppointmentDate($date, $order_id, $service_provider_id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `appointment` SET 
                    date = ?
                    WHERE order_id = ? AND service_provider_id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('sii', $date, $order_id, $service_provider_id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


function createAppointment($date, $service_provider_id) {
    $conn = db_conn();

    // Construct the SQL query
    $insertQuery = "INSERT INTO `appointment` (date, service_provider_id) VALUES (?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param('si', $date, $service_provider_id);

        // Execute the query
        $stmt->execute();

        // Return the ID of the newly inserted user
        $newUserId = $stmt->insert_id;

        // Close the statement
        $stmt->close();

        return $newUserId;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return -1;
    }
}
