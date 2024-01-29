<?php
// Include the database connection file
include 'db_connection.php';

// Create default admin account
$admin_username = "admin";
$admin_password = password_hash("admin_password", PASSWORD_DEFAULT);
$admin_role = "admin";

// Create default staff account
$staff_username = "staff";
$staff_password = password_hash("staff_password", PASSWORD_DEFAULT);
$staff_role = "staff";

// Insert default admin account
$sqlAdmin = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
if ($stmtAdmin = $mysqli->prepare($sqlAdmin)) {
    $stmtAdmin->bind_param("sss", $admin_username, $admin_password, $admin_role);
    $stmtAdmin->execute();
    $stmtAdmin->close();
}

// Insert default staff account
$sqlStaff = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
if ($stmtStaff = $mysqli->prepare($sqlStaff)) {
    $stmtStaff->bind_param("sss", $staff_username, $staff_password, $staff_role);
    $stmtStaff->execute();
    $stmtStaff->close();
}

// Close connection
$mysqli->close();

echo "Default admin and staff accounts created successfully.";
?>
