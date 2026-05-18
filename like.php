<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['post_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

// Vérifier si le like existe déjà
$stmt = $pdo->prepare("SELECT id FROM likes WHERE user_id = ? AND post_id = ?");
$stmt->execute([$user_id, $post_id]);

if ($stmt->rowCount() > 0) {
    // Like existe, le supprimer
    $stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
    $stmt->execute([$user_id, $post_id]);
} else {
    // Like n'existe pas, l'ajouter
    $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $post_id]);
}

header("Location: index.php");
exit();
?>