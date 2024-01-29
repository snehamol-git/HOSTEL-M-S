<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db_connection.php';

// Retrieve complaints
$sql = "SELECT complaints.complaint_id, students.full_name, complaints.subject, complaints.message, complaints.submission_date, complaints.status
        FROM complaints
        INNER JOIN students ON complaints.student_id = students.student_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Complaint ID</th><th>Student Name</th><th>Subject</th><th>Message</th><th>Submission Date</th><th>Status</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['complaint_id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['submission_date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='resolve_complaint.php?complaint_id=" . $row['complaint_id'] . "'>Resolve</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No complaints found.";
}

// Close connection
$mysqli->close();
?>

</body>
</html>
