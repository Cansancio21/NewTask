<?php
$host = 'localhost'; // Database host
$user = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP (usually empty)
$database = 'task_management'; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
