<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomNumber = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO rooms (room_number, capacity) VALUES ('$roomNumber', '$capacity')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Room added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$mysqli->close();
?>
