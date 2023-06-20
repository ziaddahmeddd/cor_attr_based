<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'con.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $department = null;

        if ($role === "admin") {
            $admin_check = $pdo->query("SELECT * FROM users15 WHERE role='admin'");
            if ($admin_check->rowCount() > 0) {
                die("Only one admin is allowed.");
            }
        } else {
            $department = $_POST['department'];
            if ($department === "") {
                die("Please select a department.");
            }
        }

        if (empty($username) || empty($password) || empty($role)) {
            die("Please fill in all fields.");
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users15 (username, password, role, department) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $role, $department]);

        if ($stmt->rowCount() > 0) {
            if ($role === "user") {
                header("Location: login.html");
            } else {
                header("Location: login.html");
            }
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        die("This page is for form submission only.");
    }
?>
