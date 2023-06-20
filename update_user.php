<?php
    session_start();
    require 'con.php';

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: login.html");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $newPassword = $_POST['password'];
        $newDepartment = $_POST['department'];

        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users15 SET password = ?, department = ? WHERE username = ?");
        $stmt->execute([$newPasswordHash, $newDepartment, $username]);

        echo "User " . $username . " has been updated.";
    } else {
        echo "Invalid request.";
    }
?>
