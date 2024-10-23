<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anime"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";

// Variables
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$DOB = $_POST['dob'];
$email = $_POST['email'];
$password = $_POST['password']; // Plain text password entered by the user

// Prepare SQL statement to insert user data into the database
$stmt = $conn->prepare("INSERT INTO user (first_name, last_name, dob, email, pass) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $DOB, $email, $password);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Registration successful!'); window.location.href = 'login.html';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'login.html';</script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
