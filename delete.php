<?php
$conn = new mysqli("localhost", "root", "2006", "contact");

$id = $_GET['id'];

$sql = "DELETE FROM contacts WHERE id=$id";
$conn->query($sql);

header("Location: list.php");
?>