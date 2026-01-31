<?php
session_start();
if($_SESSION['role'] != 'admin'){
    exit("Access Denied");
}

$conn = new mysqli("localhost", "root", "", "contact");

/* TOTAL USERS */
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

/* TOTAL CONTACTS */
$totalContacts = $conn->query("SELECT COUNT(*) AS total FROM contacts")->fetch_assoc()['total'];

/* CONTACTS PER USER */
$users = $conn->query("
    SELECT users.username, COUNT(contacts.id) AS total_contacts
    FROM users
    LEFT JOIN contacts ON users.id = contacts.user_id
    GROUP BY users.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body { font-family: Arial; background:#f2f5ff; padding:20px; }
.card { background:white; padding:20px; margin:15px 0; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2);}
h2 { color:#4b5cff; }
table { width:100%; border-collapse: collapse; }
th, td { padding:10px; text-align:center; }
th { background:#4b5cff; color:white; }
tr:nth-child(even){ background:#eef2ff; }
</style>
</head>

<body>

<h1>👑 Admin Dashboard</h1>

<div class="card">
    <h2>👥 Total Registered Users: <?php echo $totalUsers; ?></h2>
</div>

<div class="card">
    <h2>📇 Total Contacts in System: <?php echo $totalContacts; ?></h2>
</div>

<div class="card">
    <h2>📊 Contacts Per User</h2>
    <table>
        <tr><th>Username</th><th>Total Contacts</th></tr>
        <?php while($row = $users->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['total_contacts']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>