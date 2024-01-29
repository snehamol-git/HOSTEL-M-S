<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Details</title>
    <style>
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

    <h2>Add Payment Details</h2>

    <form action="process_payment.php" method="post">
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

        <label for="payment_amount">Payment Amount:</label>
        <input type="text" name="payment_amount" required>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" required>

        <button type="submit">Add Payment</button>
    </form>

</body>
</html>
