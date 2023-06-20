<?php
    session_start();
    require 'con.php';

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: login.html");
        exit();
    }

    $sql = "SELECT COUNT(*) FROM users";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();
    $userCount = $stmt->fetchColumn();

    echo "There are " . $userCount . " users.<br>";

    echo '
    <h2>Delete a user</h2>
    <form action="delete.php" method="post">
        Username: <input type="text" name="username"><br>
        <input type="submit">
    </form>
    ';

?>

<h2>Update a user</h2>
<form action="update_user.php" method="post">
    Username: <input type="text" name="username" required><br>
    New Password: <input type="password" name="password" required><br>
    New Department: <input type="text" name="department" required><br>
    <input type="submit" value="Update User">
</form>
