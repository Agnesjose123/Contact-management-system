<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "2006"; // Your MySQL password
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Get contact ID from URL
if(!isset($_GET['id'])) {
    header("Location: list.php");
    exit;
}

$id = $_GET['id'];

// Fetch current contact data
$result = $conn->query("SELECT * FROM contacts WHERE id=$id");
if($result->num_rows != 1) {
    echo "Contact not found!";
    exit;
}
$contact = $result->fetch_assoc();

// Handle form submission
if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $conn->query("UPDATE contacts SET name='$name', phone='$phone', email='$email' WHERE id=$id");
    header("Location: list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #3333cc;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #ffcc00;
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #ffb700;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #3333cc;
            font-weight: bold;
        }
        a:hover { color: #000099; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Contact</h2>
        <form method="POST">
            <input type="text" name="name" value="<?php echo $contact['name']; ?>" required>
            <input type="text" name="phone" value="<?php echo $contact['phone']; ?>" required>
            <input type="email" name="email" value="<?php echo $contact['email']; ?>" required>
            <input type="submit" name="update" value="Update Contact">
        </form>
        <a href="list.php">Back to Contact List</a>
    </div>
</body>
</html>