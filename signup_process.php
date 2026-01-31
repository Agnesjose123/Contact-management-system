<?php
include "db.php";

$name  = $_POST['name'];
$email = $_POST['email'];
$pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

$check = $conn->query("SELECT id FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    die("Email already exists");
}

$conn->query("INSERT INTO users (name, email, password)
              VALUES ('$name','$email','$pass')");

header("Location: login.php");
?>