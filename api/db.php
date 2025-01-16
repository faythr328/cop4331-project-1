<?php

$servername = "localhost";
$username = "dbmanager";
$password = "Ilovedb4331";
$dbname = "COP4331db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection success<br>";

?>

