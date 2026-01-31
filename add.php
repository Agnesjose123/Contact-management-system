<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Contact</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(135deg,#36b9cc,#4e73df);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.form-box {
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    width:350px;
}
h2 {
    text-align:center;
    color:#4e73df;
}
input {
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:6px;
    border:1px solid #ccc;
}
button {
    width:100%;
    padding:10px;
    background:#1cc88a;
    border:none;
    color:white;
    border-radius:6px;
    cursor:pointer;
}
button:hover {
    background:#17a673;
}
</style>
</head>
<body>

<div class="form-box">
<h2>Add Contact</h2>
<form action="save.php" method="POST" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Name" required>
<input type="text" name="phone" placeholder="Phone" required>
<input type="email" name="email" placeholder="Email" required>
<input type="date" name="dob">
<input type="file" name="photo">
<button type="submit">Save Contact</button>
</form>
</div>

</body>
</html>