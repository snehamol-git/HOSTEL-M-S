<?php
// Include the database connection file
include 'db_connection.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "Please enter your username.";
    } else {
        $username = $_POST["username"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Please enter your password.";
    } else {
        $password = $_POST["password"];
    }

    // Check input errors before authenticating
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT u.username, u.password, u.role, s.student_id FROM users u LEFT JOIN students s ON u.username = s.username WHERE u.username = ?";
        
        

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                

                // Store result
                $stmt->store_result();

// Check if the username exists, if yes then verify password
if ($stmt->num_rows >0) {
    // Bind result variables
    $stmt->bind_result($db_username, $db_hashed_password, $db_role, $db_student_id);
    if ($stmt->fetch()) {
        
    
        if (password_verify($password, $db_hashed_password)) {
            // Password is correct, so start a new session
            session_start();
    
            // Store data in session variables
            $_SESSION["username"] = $db_username;
            $_SESSION["role"] = $db_role;
            if ($db_role == "student") {
                $_SESSION["student_id"] = $db_student_id;
            }
    
            // Redirect user based on their role
            if ($db_role == "admin") {
                header("location:admin_dashboard.php");
            } elseif ($db_role == "staff") {
                header("location: staff_dashboard.php");
            } elseif ($db_role == "student") {
                header("location: student_dashboard.php");
            }
            
        } else {
            // Display an error message if the password is not valid
            $password_err = "The password you entered was not valid.";
            
        }
    } else {
        // Fetch failed
        
    }
} else {
    // Display an error message if the username doesn't exist
    $username_err = "No account found with that username.";
    
}

// ...



// ...


// ...



                            
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
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
    <title>Login</title>
    <style>
        body {
            background-image: url('mes.jpg'); /* Set your background image path */
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 300px;
            margin: 50px auto;
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
        }
    </style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
    <span class="error"><?php echo $username_err; ?></span>

    <label for="password">Password:</label>
    <input type="password" name="password">
    <span class="error"><?php echo $password_err; ?></span>

    <button type="submit">Login</button>
</form>

</body>
</html>
