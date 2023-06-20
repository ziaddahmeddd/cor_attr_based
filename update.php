<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'con.php';
$message = '';

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newDepartment = $_POST['department'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    if (empty($newDepartment)) {
        $message = "Department cannot be empty.";
    } elseif (empty($currentPassword)) {
        $message = "Please input current password.";
    } elseif (empty($newPassword)) {
        $message = "Please input new password.";
    } else {
        $newDepartment = filter_var($newDepartment, FILTER_SANITIZE_STRING);

        if (password_verify($currentPassword, $user['password'])) {
            
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            
            $stmt = $pdo->prepare("UPDATE users15 SET department = ?, password = ? WHERE id = ?");
            $stmt->execute([$newDepartment, $newPasswordHash, $user['id']]);

            
            $_SESSION['user']['department'] = $newDepartment;

            $message = "Profile updated successfully.";
        } else {
            $message = "Current password is incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
</head>
<body>
    <h1>Update Profile</h1>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="update.php" method="post">
        <label>
            Department: 
            <input type="text" name="department" value="<?php echo htmlspecialchars($user['department']); ?>" required>
        </label>
        <label>
            Current Password: 
            <input type="password" name="current_password" required>
        </label>
        <label>
            New Password: 
            <input type="password" name="new_password" required>
        </label>
        <button type="submit">Update</button>
    </form>
    <a href="dashboard.php">Back to dashboard</a>
</body>
</html>
