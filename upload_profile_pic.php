<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    $user_id = $_SESSION['user_id'];
    $file = $_FILES['profile_photo'];

    $upload_dir = "uploads/profiles/";
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
    $max_size = 2 * 1024 * 1024;

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $file_size = $file['size'];
    $error = null;

    if (!in_array($file_extension, $allowed_extensions)) {
        $error = "format_invalid";
    } elseif ($file_size > $max_size) {
        $error = "file_too_large";
    } elseif ($file['error'] !== 0) {
        $error = "upload_error";
    }

    if ($error) {
        header("Location: edit_profile.php?error=$error");
        exit();
    }

    $new_file_name = "profile_" . $user_id . "_" . time() . "." . $file_extension;
    $destination = $upload_dir . $new_file_name;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        $stmtOld = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
        $stmtOld->execute([$user_id]);
        $oldPic = $stmtOld->fetchColumn();
        if ($oldPic && file_exists($oldPic)) {
            unlink($oldPic);
        }

        $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->execute([$destination, $user_id]);

        header("Location: edit_profile.php?success=1");
    } else {
        header("Location: edit_profile.php?error=move_failed");
    }
} else {
    header("Location: edit_profile.php");
}
exit();
?>