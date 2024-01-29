<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $room_id = $_POST['room_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Perform validation if needed

    // Insert the room allocation record into the room_allocations table
    $sql = "INSERT INTO room_allocations (student_id, room_id, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iiss", $student_id, $room_id, $start_date, $end_date);

    if ($stmt->execute()) {
        echo "Room allocated successfully.";
    } else {
        echo "Error allocating room: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $mysqli->close();
}
?>
