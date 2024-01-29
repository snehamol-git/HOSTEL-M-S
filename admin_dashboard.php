<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            padding: 12px 20px;
            margin: 10px;
            font-size: 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Admin Module</h1>
        <div class="buttons-container">
            <button class="button" onclick="location.href='add_staff.html'">Add Staff</button>
            <button class="button" onclick="location.href='add_room.html'">Add Room Details</button>
            <button class="button" onclick="location.href='view_staff.php'">View Staff Details</button>
            <button class="button" onclick="location.href='view_room.php'">View Room Details</button>
        </div>
    </div>
</body>
</html>
