<?php
session_start();
require 'con.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

$username = $_POST['username'];

$sql = "DELETE FROM users15 WHERE username = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$username]);

header("Location: admin.php");
exit();
?>
