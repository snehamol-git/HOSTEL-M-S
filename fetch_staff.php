<?php
include('db_connection.php');

$sql = "SELECT * FROM staff";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["staff_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["job_role"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>No staff records found</td></tr>";
}

$mysqli->close();
?>
