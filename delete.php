<link rel="stylesheet" href="style.css">
<?php 
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM results WHERE result_id=$id");

header("Location: index.php");
exit();
?>