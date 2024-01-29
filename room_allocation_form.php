<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Allocation</title>
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

form {
    max-width: 400px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

select,
input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}


    </style>
</head>
<body>
    <h2>Room Allocation</h2>

    <form action="process_room_allocation.php" method="post">
        <label for="student_id">Select Student:</label>
        <select name="student_id">
            <?php
                // Include the database connection file
                include 'db_connection.php';

                // Fetch students from the database and populate the dropdown
                $result = $mysqli->query("SELECT student_id, full_name FROM students");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['student_id'] . "'>" . $row['full_name'] . "</option>";
                }

                // Close the database connection
                $mysqli->close();
            ?>
        </select>

        <label for="room_id">Select Room:</label>
        <select name="room_id">
            <?php
                // Include the database connection file
                include 'db_connection.php';

                // Fetch rooms from the database and populate the dropdown
                $result = $mysqli->query("SELECT room_id, room_number FROM rooms");

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['room_id'] . "'>" . $row['room_number'] . "</option>";
                }

                // Close the database connection
                $mysqli->close();
            ?>
        </select>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required>

        <button type="submit">Allocate Room</button>
    </form>
</body>
</html>
