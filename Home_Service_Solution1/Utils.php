<?php

function navigate($absolute_location)
{
    header("Location: {$absolute_location}");
}


function _Status_Badge_Color($data)
{

    $statusColor = '';
    if ($data === "Pending") {
        $statusColor = 'badge-pending';
    } elseif ($data === "Rejected") {
        $statusColor = 'badge-reject';
    }elseif ($data === "Accepted") {
        $statusColor = 'badge-accept';
    }elseif ($data === "Cancelled") {
        $statusColor = 'badge-cancelled';
    }elseif ($data === "Booked") {
        $statusColor = 'badge-booked';
    }elseif ($data === "Not-Booked") {
        $statusColor = 'badge-not-booked';
    }elseif ($data === "Completed") {
        $statusColor = 'badge-completed';
    }

    return $statusColor;

}

function countAcceptedOrders($data) {
    // Initialize a variable to store the count
    $acceptedCount = 0;

    // Loop through each row of data
    foreach ($data as $row) {
        // Check if the status is 'Accepted'
        if ($row['status'] === 'Accepted') {
            // If the status is 'Accepted', increment the count
            $acceptedCount++;
        }

    }
    return $acceptedCount;
}

function calculateTotalIncome($data) {
    // Initialize a variable to store the total income
    $totalIncome = 0;

    // Loop through each row of data
    foreach ($data as $row) {
        // Determine the income based on the service type
        switch ($row['type']) {
            case 'AC Servicing':
                $income = 2000;
                break;
            case 'Home Cleaning':
                $income = 1500;
                break;
            case 'Plumbing and Sanitation':
                $income = 3000;
                break;
            case 'House Shifting':
                $income = 5000;
                break;
            default:
                $income = 0; // Set default income to 0 for unknown service types
                break;
        }

        // Add the income to the total
        $totalIncome += $income;
    }

    // Return the total income
    return $totalIncome;
}

function getUpcomingAppointment($data) {
    // Get the current date
    $currentDate = date('Y-m-d');

    // Initialize a variable to store the upcoming appointment date
    $upcomingAppointment = null;

    // Loop through each row of data
    foreach ($data as $row) {
        // Get the date from the row
        $appointmentDate = $row['date'];

        // Check if the appointment date is greater than the current date
        if ($appointmentDate > $currentDate) {
            // If the appointment date is in the future, update the upcoming appointment
            $upcomingAppointment = $appointmentDate;

            // Break the loop since we found the upcoming appointment
            break;
        }
    }

    // Format the upcoming appointment date as '20th October 2024' if it exists
    if ($upcomingAppointment) {
        // Convert the appointment date to a DateTime object
        $dateTime = new DateTime($upcomingAppointment);

        // Format the date as desired
        $formattedDate = $dateTime->format('jS F Y');

        // Return the formatted date
        return $formattedDate;
    } else {
        // If no upcoming appointment was found, return null
        return null;
    }
}


