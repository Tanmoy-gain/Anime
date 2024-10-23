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
// Get the email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT first_name, pass FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
// Check if the user exists
if ($stmt->num_rows > 0) {
    // Bind the result to variables
    $stmt->bind_result($firstname, $stored_password);
    $stmt->fetch();
    // Compare the entered password with the stored plain text password
    if ($password === $stored_password) {
        // Authentication successful
        echo "<script>alert('Welcome, $firstname!'); window.location.href = 'index.html';</script>";
    } else {
        // Wrong password
        echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'index.html';</script>";
    }
} else {
    // User not found
    echo "<script>alert('No user found with this email.'); window.location.href = 'index.html';</script>";
}
$stmt->close();
$conn->close();
?>
