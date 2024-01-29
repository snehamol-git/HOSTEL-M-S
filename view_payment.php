<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <style>
        /* Your CSS styles here */
/* Add your CSS styles here */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #333;
}

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
    <h2>View Payments</h2>

    <?php
        // Include the database connection file
        include 'db_connection.php';

        // Retrieve payment details
        $sql = "SELECT payments.payment_id, students.full_name, payments.payment_amount, payments.payment_date
                FROM payments
                INNER JOIN students ON payments.student_id = students.student_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Payment ID</th><th>Student Name</th><th>Payment Amount</th><th>Payment Date</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['payment_id'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['payment_amount'] . "</td>";
                echo "<td>" . $row['payment_date'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No payment details found.";
        }

        // Close connection
        $mysqli->close();
    ?>
</body>
</html>
