<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
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
    <h1>Staff Dashboard</h1>
</header>

<nav>
    <a href="view_registrations.php">View Registrations</a>
    <a href="room_allocation_form.php">Allocate Room</a>
    <a href="view_room_allocations.php">Room Allocations</a>
    <a href="payment.php">Payment Details</a>
    <a href="view_payment.php">View Payment</a>
    <a href="view_attendance.php">View Attendance</a>
    <a href="take_attendance.php">Take Attendance</a>
    <a href="view_complaint.php">View Complaint</a>
    
    <!-- Add more links as needed -->
</nav>

<div class="container">
    <!-- Content of the dashboard goes here -->
    <p>Welcome to the staff dashboard. Choose an action from the navigation above.</p>
</div>

</body>
</html>
