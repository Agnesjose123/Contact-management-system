<?php
session_start();

$conn = new mysqli("localhost", "root", "2006", "contact");

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query(
    "SELECT * FROM users WHERE username='$username' AND password='$password'"
);

if($result->num_rows == 1) {
    $_SESSION['user'] = $username;
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}
?>
