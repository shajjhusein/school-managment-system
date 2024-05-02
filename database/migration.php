<?php

// MySQL database connection settings
$servername = "localhost"; // or your server IP address
$username = "admin"; // MySQL username
$password = "admin"; // MySQL password
$database = "isd1"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL file path
$sql_file = "./isd1.sql";

// Read the SQL file
$sql_contents = file_get_contents($sql_file);

// Execute multi query
if ($conn->multi_query($sql_contents) === TRUE) {
    echo "SQL dump file imported successfully.";
} else {
    echo "Error importing SQL dump file: " . $conn->error;
}

// Close connection
$conn->close();

?>
