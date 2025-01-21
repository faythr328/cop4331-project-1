<?php
// Start/resume session (access session data) 
session_start();
include 'db.php';

// Connection error check
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

// Check if form is sumbmitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ID is auto-incremented
    $Login = $_POST['Login'];
    $Password = $_POST['Password'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
}

// Prepare SQL statement to create new user
$stmt = $conn->prepare('INSERT INTO Users (Login, Password, FirstName, LastName) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $Login, $Password, $FirstName, $LastName);
$stmt->execute();
$result = $stmt->get_result();

// Check if the insert was successful
if ($result->num_rows > 0) {
    // Redirect to login page
    header('Location: ../index.html');
}

$stmt->close();
$conn->close();

?>
