<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "contact");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM contacts WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Contact</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #74ebd5, #acb6e5);
}
.form-box {
    width: 420px;
    background: white;
    padding: 25px;
    margin: 80px auto;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
}
input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
}
button {
    width: 100%;
    padding: 10px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
}
img {
    display: block;
    margin: 10px auto;
    border-radius: 50%;
}
</style>
</head>

<body>

<div class="form-box">
<h2>✏ Edit Contact</h2>

<form method="POST" action="update.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

    <!-- DOB FIELD -->
    <label>Date of Birth</label>
    <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required>

    <!-- PHOTO -->
    <img src="<?php echo $row['photo']; ?>" width="80" height="80">
    <input type="file" name="photo">

    <button type="submit">Update Contact</button>
</form>

</div>

</body>
</html>