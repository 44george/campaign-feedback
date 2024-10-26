<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";  // Replace with your actual database password
$dbname = "campaign_feedback";

// Capture form data securely
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];
$rating = $_POST['rating'];

// Connect to MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and bind the SQL statement
$stmt = mysqli_prepare($conn, "INSERT INTO feedback (name, email, feedback, rating) VALUES (?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $feedback, $rating);

    // Execute the statement and check for success
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Thank you for your feedback! Your submission was successful.</p>";
    } else {
        echo "<p>There was an error submitting your feedback. Please try again later.</p>";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "<p>Failed to prepare the statement: " . mysqli_error($conn) . "</p>";
}

// Close the database connection
mysqli_close($conn);
?>
