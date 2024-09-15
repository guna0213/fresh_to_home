<?php
// Database connection credentials
$server = 'localhost';
$username = 'root';
$password = '';  // Ensure no space in the password field
$dbname = 'visitor_c';  // Database name

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create a connection to the database
$conn = new mysqli($server, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Prepare the SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO emp (name, id, email, phone, date, time) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL query
    $stmt->bind_param("ssssss", $name, $id, $email, $phone, $date, $time);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p style='color:green; text-align:center;'>Data inserted successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
