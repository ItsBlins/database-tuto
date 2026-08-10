<?php
$servername = "localhost";
$username = "root";
$password = "sayang123"; //left blank/empty if use xampp, this is only for software DBEAVER
$dbname = "database-tuto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>