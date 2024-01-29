<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $job_role = $_POST['job_role'];

    $sql = "INSERT INTO staff (name, contact, job_role) VALUES ('$name', '$contact', '$job_role')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Staff added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$mysqli->close();
?>
