<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db_connection.php';

// Retrieve students for attendance
$sql = "SELECT * FROM students";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align: center;'>Take Attendance</h2>";
    echo "<form action='process_attendance.php' method='post'>";
    echo "<label for='attendance_date'>Date:</label>";
    echo "<input type='date' name='attendance_date' required><br>";
    echo "<table>";
    echo "<tr><th>Student ID</th><th>Full Name</th><th>Email</th><th>Contact</th><th>Department</th><th>Present</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td><input type='checkbox' name='attendance[]' value='" . $row['student_id'] . "'></td>";
        echo "</tr>";
        
    }
    echo "<button type='submit'>Submit Attendance</button>";
    echo "</table>";
    
    echo "</form>";
} else {
    echo "<p style='text-align: center;'>No students found.</p>";
}

// Close connection
$mysqli->close();
?>

</body>
</html>
