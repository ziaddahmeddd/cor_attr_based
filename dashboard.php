<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <ul>
        <li><a href="profile.php">View Profile</a></li>
        <li><a href="update.php">Update Profile</a></li>
        <li><a href="<?php echo $_SESSION['user']['page']; ?>">Go to Department</a></li>
    </ul>
</body>
</html>
