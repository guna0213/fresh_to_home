<?php
// Database connection credentials
$server = 'localhost';
$username = 'root';
$password = '';  // No space in the password field
$dbname = 'visitor_c';  // Updated database name

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create a connection to the database
$conn = mysqli_connect($server, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);

    // Prepare the SQL query
    $sql = "INSERT INTO visitor (name, email, phone, date, time, purpose) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', '$purpose')";

    // Execute the query and check for success
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green; text-align:center;'>Data inserted successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

// Close the connection
mysqli_close($conn);
?>
