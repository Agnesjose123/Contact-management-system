<?php
session_start();
$conn = new mysqli("localhost","root","","contact");
$user_id = $_SESSION['user_id'];

/* 1️⃣ Contacts Added This Month */
$month = date("m");
$year = date("Y");
$q1 = $conn->query("
SELECT COUNT(*) AS added_month 
FROM contacts 
WHERE user_id='$user_id' 
AND MONTH(created_at)='$month'
AND YEAR(created_at)='$year'
");
$addedMonth = $q1->fetch_assoc()['added_month'];

/* 4️⃣ Email Domain Analysis */
$q4 = $conn->query("
SELECT SUBSTRING_INDEX(email,'@',-1) AS domain, COUNT(*) AS total
FROM contacts
WHERE user_id='$user_id'
GROUP BY domain
ORDER BY total DESC
");

/* 5️⃣ Upcoming Birthdays */
$q5 = $conn->query("
SELECT name,dob,
DATEDIFF(
DATE_ADD(dob, INTERVAL YEAR(CURDATE())-YEAR(dob) + (DATE_FORMAT(dob,'%m-%d') < DATE_FORMAT(CURDATE(),'%m-%d')) YEAR),
CURDATE()
) AS days_left
FROM contacts
WHERE user_id='$user_id'
ORDER BY days_left ASC
LIMIT 5
");

/* 6️⃣ Duplicate Contacts */
$q6 = $conn->query("
SELECT phone, COUNT(*) AS duplicates
FROM contacts
WHERE user_id='$user_id'
GROUP BY phone
HAVING COUNT(*) > 1
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Analytics Dashboard</title>
<style>
body{font-family:Segoe UI;background:#f4f6f9;margin:0;padding:20px;}
h1{text-align:center;color:#4e73df;}
.card{background:white;padding:20px;margin:15px 0;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
table{width:100%;border-collapse:collapse;}
th,td{padding:8px;text-align:center;border-bottom:1px solid #ddd;}
th{background:#4e73df;color:white;}
.highlight{font-size:22px;color:#e74a3b;font-weight:bold;}
</style>
</head>
<body>

<h1>📊 Contact Analytics Dashboard</h1>

<div class="card">
<h2>📈 Contacts Added This Month</h2>
<div class="highlight"><?php echo $addedMonth; ?></div>
</div>

<div class="card">
<h2>📧 Email Domain Analysis</h2>
<table>
<tr><th>Domain</th><th>Contacts</th></tr>
<?php while($row=$q4->fetch_assoc()){ ?>
<tr><td><?php echo $row['domain']; ?></td><td><?php echo $row['total']; ?></td></tr>
<?php } ?>
</table>
</div>

<div class="card">
<h2>🎂 Upcoming Birthdays</h2>
<table>
<tr><th>Name</th><th>DOB</th><th>Days Left</th></tr>
<?php while($row=$q5->fetch_assoc()){ ?>
<tr><td><?php echo $row['name']; ?></td><td><?php echo $row['dob']; ?></td><td><?php echo $row['days_left']; ?></td></tr>
<?php } ?>
</table>
</div>

<div class="card">
<h2>⚠ Duplicate Contacts</h2>
<table>
<tr><th>Phone</th><th>Duplicate Count</th></tr>
<?php 
if($q6->num_rows > 0){
    while($row=$q6->fetch_assoc()){ ?>
<tr><td><?php echo $row['phone']; ?></td><td><?php echo $row['duplicates']; ?></td></tr>
<?php }} else { echo "<tr><td colspan='2'>No duplicates found 🎉</td></tr>"; } ?>
</table>
</div>

</body>
</html>