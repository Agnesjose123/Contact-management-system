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
$password = "2006"; 
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Handle delete action
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM contacts WHERE id=$id");
    header("Location: list.php");
    exit;
}

// Fetch all contacts
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Contacts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #3333cc;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #3333cc;
            color: white;
        }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #d6e0ff; }
        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .edit { background-color: #ffecb3; color: #333; border: 1px solid #ffcc00; }
        .edit:hover { background-color: #ffd633; }
        .delete { background-color: #ffcccc; color: #333; border: 1px solid #ff6666; }
        .delete:hover { background-color: #ff4d4d; color: white; }
        .add-new {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .add-new:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h2>All Contacts</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['email']."</td>
                        <td>
                            <a class='edit' href='edit.php?id=".$row['id']."'>Edit</a>
                            <a class='delete' href='list.php?delete=".$row['id']."' onclick=\"return confirm('Are you sure you want to delete this contact?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No contacts found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <a class="add-new" href="index.php">Add New Contact</a>
</body>
</html>