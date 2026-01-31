<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "contact");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$name  = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$dob   = $_POST['dob'];


// 📸 Image Upload
$photo = "";
if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

    $targetDir = "uploads/";
    if(!is_dir($targetDir)) {
        mkdir($targetDir);
    }

    $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
        $photo = $targetFilePath;
    }
}


// 📝 Insert Contact linked to user
$sql = "INSERT INTO contacts (name, phone, email, dob, photo, user_id)
        VALUES ('$name', '$phone', '$email', '$dob', '$photo', '$user_id')";

if ($conn->query($sql) === TRUE) {
    header("Location: list.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>