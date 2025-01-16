<?php
//start/resume session (access session data) 
session_start();
include 'db.php';
//connection error check
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
//check if form is sumbmitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Login = $_POST['Login'];
    $Password = $_POST['Password'];
}

//prepare SQL statement 
$stmt = $conn->prepare("SELECT ID, Password 
	 		 FROM Users
 			 WHERE Login = ?");
$stmt->bind_param("s", $Login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    //verify password
    if ($Password === $row['Password']) {
        $_SESSION['ID'] = $row['ID'];
        header("Location: ../home.html ");
        exit();
    } else {
        $error = "Invalid Password";
    }
} else {
    $error = "Invalid Login";
}

$stmt->close();
$conn->close();

?>
