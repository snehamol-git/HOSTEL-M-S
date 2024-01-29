<?php
include('db_connection.php');

$sql = "SELECT * FROM rooms";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["room_number"] . "</td><td>" . $row["capacity"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No room records found</td></tr>";
}

$mysqli->close();
?>
