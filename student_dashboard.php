<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        nav {
            background-color: #444;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Student Dashboard</h1>
</header>

<nav>
    <a href="view_yourattendance.php">View Attendance</a>
    <a href="view_yourpayment.php">View Payment</a>
    <a href="make_complaint.php">Make Complaint</a>
</nav>

<div class="container">
    <!-- Content of the student dashboard goes here -->
    <p>Welcome to your dashboard. Select an option from the navigation above.</p>
</div>

</body>
</html>
