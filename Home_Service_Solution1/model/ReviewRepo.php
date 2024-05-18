<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllReviews()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `review`';

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

function findReviewByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `review` WHERE `id` = ?';

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

function findReviewByCustomerIdAndOrderId($customer_id, $order_id)
{
    // Establish a database connection
    $conn = db_conn();

    // Prepare the SQL query with placeholders for parameters
    $selectQuery = 'SELECT * FROM `review` WHERE `customer_id` = ? AND `order_id` = ?';

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters to the prepared statement
        $stmt->bind_param("ii", $customer_id, $order_id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the review as an associative array
        $review = $result->fetch_assoc();

        // Check for an empty result set
        if (!$review) {
//            throw new Exception("No review found with customer ID: " . $customer_id . " and order ID: " . $order_id);
        }

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Return the review
        return $review;
    } catch (Exception $e) {
        // Handle exceptions
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function findAllReviewsByCustomerID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `review` WHERE `customer_id` = '.$id;

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

function updateReview($data, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `review` SET 
                    rating = ?,
                    comment = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('ssi', $data['rating'], $data['comment'],  $id);

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

function deleteReview($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `review` WHERE id = ?";

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

function createReview($rating, $comment, $order_id, $customer_id) {
    $conn = db_conn();

    // Construct the SQL query
    $insertQuery = "INSERT INTO `review` (rating, comment, order_id, customer_id) VALUES (?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param('ssii', $rating, $comment, $order_id, $customer_id);

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
