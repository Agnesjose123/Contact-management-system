<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(120deg,#89f7fe,#66a6ff);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.box {
    background: white;
    padding: 30px;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
h2 { text-align: center; color: #3333cc; }
input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}
button {
    width: 100%;
    padding: 10px;
    background: #4CAF50;
    color: white;
    border: none;
}
.error { color: red; text-align: center; }
</style>
</head>
<body>

<div class="box">
<h2>Login</h2>

<?php if(isset($_GET['error'])) echo "<p class='error'>Invalid Login</p>"; ?>

<form action="login_check.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
</div>

</body>
</html>
