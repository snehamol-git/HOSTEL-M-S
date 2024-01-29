<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Room Allocations</title>
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
    margin-top: 20px;
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

/* Optional: Add some responsiveness */
@media screen and (max-width: 600px) {
    table {
        width: 100%;
    }

    th, td {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
}


    </style>
</head>
<body>
    <h2>View Room Allocations</h2>

    <?php
        // Include the database connection file
        include 'db_connection.php';

        // Retrieve room allocations
        $sql = "SELECT room_allocations.allocation_id, students.full_name, rooms.room_number, room_allocations.start_date, room_allocations.end_date
                FROM room_allocations
                INNER JOIN students ON room_allocations.student_id = students.student_id
                INNER JOIN rooms ON room_allocations.room_id = rooms.room_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Allocation ID</th><th>Student Name</th><th>Room Number</th><th>Start Date</th><th>End Date</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['allocation_id'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['room_number'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No room allocations found.";
        }

        // Close connection
        $mysqli->close();
    ?>
</body>
</html>
