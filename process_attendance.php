<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['attendance']) && is_array($_POST['attendance'])) {
        $date = date("Y-m-d");

        foreach ($_POST['attendance'] as $student_id) {
            // Check if attendance record already exists for the student on the given date
            $check_sql = "SELECT * FROM attendance WHERE student_id = ? AND date = ?";
            $check_stmt = $mysqli->prepare($check_sql);
            $check_stmt->bind_param("is", $student_id, $date);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows == 0) {
                // Insert attendance record
                $insert_sql = "INSERT INTO attendance (student_id, date, status) VALUES (?, ?, 'present')";
                $insert_stmt = $mysqli->prepare($insert_sql);
                $insert_stmt->bind_param("is", $student_id, $date);

                if ($insert_stmt->execute()) {
                    // Successful insertion
                } else {
                    echo "Error inserting attendance: " . $insert_stmt->error;
                }

                // Close statement
                $insert_stmt->close();
            }

            // Close result set
            $check_result->close();
        }

        echo "Attendance updated successfully.";
    } else {
        echo "No students selected for attendance.";
    }
} else {
    echo "Invalid request.";
}

// Close connection
$mysqli->close();
?>
