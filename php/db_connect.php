<?php
$servername = "localhost"; // server address (localhost for XAMPP)
$username = "root";       // Default username for XAMPP is 'root'
$password = "";           // Default password for XAMPP is empty
$dbname = "talent_sphere"; // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>