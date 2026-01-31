<?php
$conn = new mysqli("localhost", "root", "", "contact");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO users(username,password) VALUES('$user','$pass')";
    if ($conn->query($sql)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Error creating account!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<style>
body {
    margin:0;
    font-family: Arial, sans-serif;
    background: linear-gradient(120deg,#ff758c,#ff7eb3,#a18cd1,#fbc2eb);
    background-size: 300% 300%;
    animation: bgmove 10s ease infinite;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

@keyframes bgmove {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

.box {
    background:white;
    padding:35px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
    width:320px;
}

h2 {
    color:#ff6f61;
    margin-bottom:20px;
}

input {
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
    transition:0.3s;
}

input:focus {
    border-color:#ff6f61;
    outline:none;
    box-shadow:0 0 8px #ffb3a7;
}

button {
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:8px;
    border:none;
    background:linear-gradient(120deg,#ff6f61,#ff9472);
    color:white;
    font-weight:bold;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover {
    transform:scale(1.05);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

a {
    text-decoration:none;
    color:#6a11cb;
    font-weight:bold;
}

.error {
    color:red;
    margin-bottom:10px;
}
</style>
</head>

<body>
<div class="box">
<h2>Create Account 🎉</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Create Account</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>