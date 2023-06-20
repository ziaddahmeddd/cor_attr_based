<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Department: <?php echo htmlspecialchars($user['department']); ?></p>
    <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>

    <a href="dashboard.php">Back to dashboard</a>
</body>
</html>
