<?php
$servername = "localhost";
$username = "root";
$password = "2006";
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Insert into database
$sql = "INSERT INTO contacts (name, phone, email) VALUES ('$name', '$phone', '$email')";
if ($conn->query($sql) === TRUE) {
    // Success message HTML
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Contact Saved</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f0f8ff;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .message-box {
                background: #ffffff;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
                text-align: center;
            }
            .message-box h2 {
                color: #4CAF50;
            }
            .message-box a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                background: #3333cc;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
            }
            .message-box a:hover {
                background: #000099;
            }
        </style>
    </head>
    <body>
        <div class='message-box'>
            <h2>✅ Contact Saved Successfully!</h2>
            <a href='index.php'>Add Another Contact</a> 
            <a href='list.php'>View All Contacts</a>
        </div>
    </body>
    </html>
    ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>