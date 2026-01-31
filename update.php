<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "contact");

$id    = $_POST['id'];
$name  = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$dob   = $_POST['dob'];

// Handle photo update
if (!empty($_FILES['photo']['name'])) {
    $photo = "uploads/" . time() . "_" . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], $photo);

    $sql = "UPDATE contacts 
            SET name='$name', phone='$phone', email='$email', dob='$dob', photo='$photo'
            WHERE id=$id";
} else {
    $sql = "UPDATE contacts 
            SET name='$name', phone='$phone', email='$email', dob='$dob'
            WHERE id=$id";
}

$conn->query($sql);
header("Location: list.php");
?>