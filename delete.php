<?php
$conn = new mysqli("localhost", "root", "", "contact");

$id = $_GET['id'];

$sql = "DELETE FROM contacts WHERE id=$id";
$conn->query($sql);

header("Location: list.php");
?>