<?php
session_start();
$conn = new mysqli("localhost", "root", "", "contact");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
	$_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
        header("Location: list.php");
	echo $row['role'];
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    width: 350px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #4e73df;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
}

button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #36b9cc, #4e73df);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.05);
    background: linear-gradient(45deg, #1cc88a, #36b9cc);
}

.error {
    color: red;
    margin-top: 10px;
}

.signup-link {
    margin-top: 15px;
    display: block;
    color: #4e73df;
    text-decoration: none;
}

.signup-link:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="login-box">
    <h2>Welcome Back 👋</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <a class="signup-link" href="signup.php">New user? Sign Up</a>
</div>

</body>
</html>