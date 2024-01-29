<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Your Payment</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db_connection.php';

// Assume that you have a session for the logged-in student
session_start();
$student_id = $_SESSION['student_id'];

// Retrieve payment details for the logged-in student
$sql = "SELECT * FROM payments WHERE student_id = ?";
if ($stmt = $mysqli->prepare($sql)) {
    // Bind the parameter to the statement
    $stmt->bind_param("i", $student_id);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Your Payment Details</h2>";
        echo "<table>";
        echo "<tr><th>Date</th><th>Amount</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['payment_date'] . "</td>";
            echo "<td>" . $row['payment_amount'] . "</td>";
            
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No payment records found.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: " . $mysqli->error;
}

// Close the connection
$mysqli->close();
?>

</body>
</html>
