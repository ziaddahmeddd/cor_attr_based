<?php
    session_start(); // start session at the beginning
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'con.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            die("Please fill in all fields.");
        }

        $stmt = $pdo->prepare("SELECT * FROM users15 WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            // Store the department page in the session
            if ($user['department'] === 'HR') {
                $_SESSION['user']['page'] = 'hr.html';
            } elseif ($user['department'] === 'finance') {
                $_SESSION['user']['page'] = 'finance.html';
            }

            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: dashboard.php");
            }

            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        die("This page is for form submission only.");
    }
?>
