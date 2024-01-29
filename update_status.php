<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Registration Status</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            max-width: 350px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Additional styling for disabled input fields */
        input:disabled {
            background-color: #f9f9f9;
            color: #777;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db_connection.php';

// Check if student_id is provided in the URL
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Retrieve student details
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $full_name = $row['full_name'];
            $email = $row['email'];
            $contact = $row['contact'];
            $department = $row['department'];
            $status = $row['status'];
        } else {
            echo "Invalid student ID.";
            exit();
        }
    } else {
        echo "Error: " . $stmt->error;
        exit();
    }

    // Close statement
    $stmt->close();
} else {
    echo "Student ID not provided.";
    exit();
}

// Check if the status form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = $_POST['new_status'];

    // Update the status in the database
    $update_sql = "UPDATE students SET status = ? WHERE student_id = ?";
    $update_stmt = $mysqli->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $student_id);

    if ($update_stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $update_stmt->error;
    }

    // Close statement
    $update_stmt->close();
}
?>

<h2>Update Registration Status</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?student_id=' . $student_id; ?>" method="post">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" value="<?php echo $full_name; ?>" disabled><br>

    <label for="email">Email:</label>
    <input type="text" name="email" value="<?php echo $email; ?>" disabled><br>

    <label for="contact">Contact:</label>
    <input type="text" name="contact" value="<?php echo $contact; ?>" disabled><br>

    <label for="department">Department:</label>
    <input type="text" name="department" value="<?php echo $department; ?>" disabled><br>

    <label for="status">Current Status:</label>
    <input type="text" name="status" value="<?php echo $status; ?>" disabled><br>

    <label for="new_status">New Status:</label>
    <select name="new_status">
        <option value="accepted">Accepted</option>
        <option value="rejected">Rejected</option>
    </select><br>

    <button type="submit">Update Status</button>
</form>

</body>
</html>
