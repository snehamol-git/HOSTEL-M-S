<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Validate and sanitize the data if needed

    // Prepare and execute the SQL query to insert the inquiry into the database
    $sql = "INSERT INTO inquiries (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Inquiry submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
} else {
    // If the form is not submitted, redirect to the inquiry page
    header("Location: inquiry_page.php");
    exit();
}
?>
