<?php
// resolve_complaint.php

// Include the database connection file
include 'db_connection.php';

// Check if the complaint_id is provided
if (isset($_GET['complaint_id'])) {
    $complaint_id = $_GET['complaint_id'];

    // Update the status to "Resolved"
    $update_sql = "UPDATE complaints SET status = 'Resolved' WHERE complaint_id = ?";
    $stmt = $mysqli->prepare($update_sql);
    $stmt->bind_param("i", $complaint_id);

    if ($stmt->execute()) {
        echo "Complaint resolved successfully.";
    } else {
        echo "Error resolving complaint: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Complaint ID not provided.";
}

// Close connection
$mysqli->close();
?>
