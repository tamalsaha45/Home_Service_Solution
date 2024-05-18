<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllCustomers()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `customer`';

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
    } finally {
        // Close the database connection
        $conn->close();
    }
}


function findCustomerByUsernameAndPassword($username, $password) {
    $conn = db_conn();

    // Use prepared statement to prevent SQL injection
    $selectQuery = 'SELECT * FROM `customer` WHERE `username` = ?';

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


function findCustomerByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `customer` WHERE `id` = ?';

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
    } finally {
        // Close the database connection
        $conn->close();
    }
}


function updateCustomer($name, $phone, $address, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `customer` SET 
                    name = ?,
                    phone = ?,
                    address = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('sssi', $name, $phone, $address,  $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}


function deleteCustomer($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `customer` WHERE id = ?";

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
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}


function createCustomer($name, $phone, $address, $username, $password) {
    $conn = db_conn();

    // Construct the SQL query
    $insertQuery = "INSERT INTO `customer` (name, phone, address, username, password) VALUES (?, ?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param('sssss', $name, $phone, $address, $username, $password);

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
    } finally {
        // Close the database connection
        $conn->close();
    }
}
