<?php
// Include the database connection file
include 'db_connection.php';

// Assume that you have a session for the logged-in student
session_start();
$student_id = $_SESSION['student_id'];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve complaint details from the form
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Insert the complaint into the database
    $sql = "INSERT INTO complaints (student_id, subject, message) VALUES (?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("iss", $student_id, $subject, $message);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Complaint submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the connection
    $mysqli->close();
}
?>
