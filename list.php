<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "contact");
$user_id = $_SESSION['user_id'];

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM contacts 
            WHERE user_id='$user_id' 
            AND (name LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%')";
} else {
    $sql = "SELECT * FROM contacts WHERE user_id='$user_id'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Contacts</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(120deg,#84fab0,#8fd3f4);
    padding: 20px;
}
.container {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 15px gray;
}
h1 { color: #ff4081; text-align:center; }
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th {
    background: #ff4081;
    color: white;
    padding: 10px;
}
td {
    padding: 10px;
    text-align: center;
}
tr:nth-child(even) { background: #f2f2f2; }
.btn {
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
}
.edit { background: #4caf50; }
.delete { background: #f44336; }
.email { background: #2196f3; }
.searchbox {
    padding: 8px;
    width: 250px;
    border-radius: 10px;
    border: 1px solid gray;
}
.btn-dashboard {
    background: linear-gradient(45deg, #ff6a00, #ffcc00);
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.3);
    transition: 0.3s ease;
    display: inline-block;
}

.btn-dashboard:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0,0,0,0.4);
    background: linear-gradient(45deg, #ff8c00, #ffd700);
}
</style>
</head>
<body>

<div class="container">
<h1>📒 My Contact List</h1>

<form method="GET">
    <input type="text" name="search" class="searchbox" placeholder="Search..." value="<?php echo $search; ?>">
    <button type="submit">🔍</button>
    <a href="add.php" class="btn edit">➕ Add Contact</a>
    <a href="logout.php" style="
        background:#ff1744;
        color:white;
        padding:8px 15px;
        border-radius:8px;
        text-decoration:none;
        font-weight:bold;
    ">🚪 Logout</a>
<a href="dashboard.php" class="btn-dashboard">📊 Dashboard</a>
<a href="admin_dashboard.php" class="btn-dashboard">👑 Admin Panel</a>

<!-- 🎂 Birthday Reminder -->
<h2 style="color:#ff9800;">🎂 Today's Birthdays</h2>
<?php
$bday = $conn->query("
SELECT name,email FROM contacts 
WHERE user_id='$user_id'
AND MONTH(dob)=MONTH(CURDATE()) 
AND DAY(dob)=DAY(CURDATE())
");

if ($bday->num_rows > 0) {
    while($b = $bday->fetch_assoc()) {
        echo "🎉 ".$b['name']." 
        <a class='btn email' href='mailto:".$b['email']."?subject=Happy Birthday'>Wish</a><br>";
    }
} else {
    echo "No birthdays today 🎈";
}
?>

<table>
<tr>
<th>Photo</th>
<th>Name</th>
<th>Phone</th>
<th>Email</th>
<th>DOB</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><img src="<?php echo $row['photo']; ?>" width="50" height="50"></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['dob']; ?></td>
<td>
    <a class="btn edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
    <a class="btn delete" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
    <a class="btn email" href="mailto:<?php echo $row['email']; ?>">Email</a>
</td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>