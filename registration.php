<?php
// Include the database connection file
include 'db_connection.php';

// Define variables and initialize with empty values
$full_name = $email = $contact = $department = $age = $place = $username = $password = $role = $status = "";
$full_name_err = $email_err = $contact_err = $department_err = $age_err = $place_err = $username_err = $password_err = $role_err = $status_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate full name
    if (empty($_POST["full_name"])) {
        $full_name_err = "Please enter your full name.";
    } else {
        $full_name = $_POST["full_name"];
    }

    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = $_POST["email"];
    }

    // Validate contact number
    if (empty($_POST["contact"])) {
        $contact_err = "Please enter your contact number.";
    } elseif (!ctype_digit($_POST["contact"]) || strlen($_POST["contact"]) !== 10) {
        $contact_err = "Contact number should be numeric and exactly 10 digits.";
    } else {
        $contact = $_POST["contact"];
    }

    // Validate department
    if (empty($_POST["department"])) {
        $department_err = "Please enter your department.";
    } else {
        $department = $_POST["department"];
    }

    // Validate age
    if (empty($_POST["age"])) {
        $age_err = "Please enter your age.";
    } elseif (!ctype_digit($_POST["age"])) {
        $age_err = "Age must be a numeric value.";
    } else {
        $age = $_POST["age"];
    }

    // Validate place
    if (empty($_POST["place"])) {
        $place_err = "Please enter your place.";
    } else {
        $place = $_POST["place"];
    }

    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "Please enter a username.";
    } else {
        $username = $_POST["username"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Please enter a password.";
    } else {
        $password = $_POST["password"];
    }

    // Validate role
    if (empty($_POST["role"])) {
        $role_err = "Please enter the role.";
    } else {
        $role = $_POST["role"];
    }

    // Validate status
    if (empty($_POST["status"])) {
        $status_err = "Please enter the status.";
    } else {
        $status = $_POST["status"];
    }

    // Check input errors before inserting into the database
    if (empty($full_name_err) && empty($email_err) && empty($contact_err) && empty($department_err) && empty($age_err) && empty($place_err) && empty($username_err) && empty($password_err) && empty($role_err) && empty($status_err)) {
        
        // Prepare an insert statement for students table
        $sql_students = "INSERT INTO students (full_name, email, contact, department, age, place, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt_students = $mysqli->prepare($sql_students)) {
            // Bind variables to the prepared statement as parameters
            $stmt_students->bind_param("ssssisssss", $full_name, $email, $contact, $department, $age, $place, $username, $password, $role, $status);
            
            // Attempt to execute the prepared statement
            if ($stmt_students->execute()) {
                echo "Student registration submitted for approval.";

                // Close statement
                $stmt_students->close();
            } else {
                echo "Error: " . $stmt_students->error;
            }
        } else {
            echo "Error: " . $mysqli->error;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement for users table
        $sql_users = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";

        if ($stmt_users = $mysqli->prepare($sql_users)) {
            // Bind variables to the prepared statement as parameters
            $stmt_users->bind_param("sss", $username, $hashed_password, $role);

            // Attempt to execute the prepared statement
            if ($stmt_users->execute()) {
                echo "Records inserted successfully.";

                // Close statement
                $stmt_users->close();
            } else {
                echo "Error: " . $stmt_users->error;
            }
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            background-image: url('mes.jpg'); /* Set your background image path */
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

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

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Student Registration Form</h2>
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
        <span class="error"><?php echo $full_name_err; ?></span>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $email_err; ?></span>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo $contact; ?>">
        <span class="error"><?php echo $contact_err; ?></span>

        <label for="department">Department:</label>
        <input type="text" name="department" value="<?php echo $department; ?>">
        <span class="error"><?php echo $department_err; ?></span>

        <label for="age">Age:</label>
        <input type="text" name="age" value="<?php echo $age; ?>">
        <span class="error"><?php echo $age_err; ?></span>

        <label for="place">Place:</label>
        <input type="text" name="place" value="<?php echo $place; ?>">
        <span class="error"><?php echo $place_err; ?></span>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $username_err; ?></span>

        <label for="password">Password:</label>
        <input type="password" name="password">
        <span class="error"><?php echo $password_err; ?></span>

        <label for="role">Role:</label>
        <select name="role">
            <option value="student" <?php echo ($role === 'student') ? 'selected' : ''; ?>>Student</option>
            
        </select>
        <span class="error"><?php echo $role_err; ?></span>

        <label for="status">Status:</label>
        <select name="status">
            <option value="pending" <?php echo ($status === 'pending') ? 'selected' : ''; ?>>Pending</option>
            <!-- Add more options as needed -->
        </select>
        <span class="error"><?php echo $status_err; ?></span>

        <button type="submit">Register</button>
    </form>
</body>
</html>
