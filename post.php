<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, content, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$_SESSION['user_id'], $_POST['content']]);
    header("Location: index.php");
    exit();
}

header("Location: index.php");
exit();
?>