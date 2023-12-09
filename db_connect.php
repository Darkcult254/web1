<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";       // Use "root" as the username
$password = "";           // Leave the password empty
$dbname = "igult_database";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Could not connect to MySQL: " . $conn->connect_error);
} else {
    //echo "Connected successfully";
}
?>

