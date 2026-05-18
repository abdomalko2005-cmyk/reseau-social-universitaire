<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

include 'header.php';
?>

<style>
    .profile-container {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }
    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .profile-pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #2563eb;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 15px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #1e293b;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        padding: 12px;
        background-color: #2563eb;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    button:hover {
        background-color: #1d4ed8;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-pic"><?= substr($user['username'], 0, 1) ?></div>
        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <p><?= htmlspecialchars($user['email']) ?></p>
    </div>
    <form method="POST" action="upload_profile_pic.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Photo de profil</label>
            <input type="file" name="profile_photo" accept="image/*">
        </div>
        <button type="submit">Télécharger la photo</button>
    </form>
</div>

<?php include 'footer.php'; ?>