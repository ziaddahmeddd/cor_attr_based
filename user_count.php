<?php
require 'con.php';

$stmt = $pdo->query("SELECT COUNT(*) AS total FROM users15");
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$userCount = $data['total'];

echo $userCount;
?>
