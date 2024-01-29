<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST["student_id"];
    $payment_amount = $_POST["payment_amount"];
    $payment_date = $_POST["payment_date"];

    // Validate the data if needed

    // Insert payment details into the database
    $sql = "INSERT INTO payments (student_id, payment_amount, payment_date) VALUES (?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ids", $student_id, $payment_amount, $payment_date);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Payment details added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}
?>
