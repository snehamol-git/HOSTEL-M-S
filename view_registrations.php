<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations</title>
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

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db_connection.php';

// Retrieve pending registrations
$sql = "SELECT * FROM students WHERE status = 'pending'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Pending Registrations</h2>";
    echo "<table>";
    echo "<tr><th>Student ID</th><th>Full Name</th><th>Email</th><th>Contact</th><th>Department</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td><a href='update_status.php?student_id=" . $row['student_id'] . "'>Update Status</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No pending registrations.";
}

// Close connection
$mysqli->close();
?>

</body>
</html>
