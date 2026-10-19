<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "far_far_away";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Optional: success message for testing
// echo "Connected successfully";