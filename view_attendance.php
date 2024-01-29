<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
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

// Retrieve students and their attendance with date
$sql = "SELECT students.student_id, students.full_name, students.email, students.contact, students.department, attendance.date, attendance.status
        FROM students
        LEFT JOIN attendance ON students.student_id = attendance.student_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Student Attendance</h2>";
    echo "<table>";
    echo "<tr><th>Student ID</th><th>Full Name</th><th>Email</th><th>Contact</th><th>Department</th><th>Date</th><th>Attendance Status</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No students found.";
}

// Close connection
$mysqli->close();
?>

</body>
</html>
