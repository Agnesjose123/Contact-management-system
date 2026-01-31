
<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Contact</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #74ebd5, #acb6e5);
}
.form-box {
    width: 400px;
    background: white;
    padding: 25px;
    margin: 80px auto;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
    color: #333;
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
    font-size: 16px;
}
button:hover {
    background: #388e3c;
}
a {
    display: block;
    text-align: center;
    margin-top: 10px;
}
</style>
</head>

<body>

<div class="form-box">
<h2>➕ Add New Contact</h2>

<form method="POST" action="save.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="date" name="dob" required>
    <input type="file" name="photo">
    <button type="submit">Save Contact</button>
</form>

<a href="list.php">📋 View Contacts</a>
</div>

</body>
</html>
