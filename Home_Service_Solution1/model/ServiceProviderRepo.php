<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllServiceProvider()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `service_provider`';

    try {
        $result = $conn->query($selectQuery);

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

function findServiceProviderByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `service_provider` WHERE `id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

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

        $stmt->close();

        return $user;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findServiceProviderByUsernameAndPassword($username, $password) {
    $conn = db_conn();

    // Use prepared statement to prevent SQL injection
    $selectQuery = 'SELECT * FROM `service_provider` WHERE `username` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Bind parameters
        $stmt->bind_param("s", $username);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Close the result set
        $result->close();

        // Close the statement
        $stmt->close();

        // Check if the user exists and if the password matches
        if ($user &&  $user['password'] === $password) {
            // Password is correct
            return $user;
        } else {
            // Password is incorrect or user doesn't exist
            return null;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}



function updateServiceProviderStatus($status, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `service_provider` SET 
                    status = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('si', $status,  $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}

function deleteServiceProvider($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `service_provider` WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameter
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}

function createServiceProvider($username, $password, $status, $profile_mode) {
    $conn = db_conn();

    // Construct the SQL query
    $insertQuery = "INSERT INTO `service_provider` (username, password, status, profile_mode) VALUES (?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param('ssss', $username, $password, $status, $profile_mode);

        // Execute the query
        $stmt->execute();

        // Return the ID of the newly inserted user
        $newUserId = $stmt->insert_id;

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        return $newUserId;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return -1;
    }
}
