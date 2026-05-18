<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php';

// Récupérer les posts
$stmt = $pdo->prepare("
    SELECT p.*, u.username, u.profile_pic, f.nom as filiere,
           COUNT(DISTINCT l.id) as likes_count,
           COUNT(DISTINCT c.id) as comments_count
    FROM posts p
    JOIN users u ON p.user_id = u.id
    LEFT JOIN filieres f ON u.filiere_id = f.id
    LEFT JOIN likes l ON p.id = l.post_id
    LEFT JOIN comments c ON p.id = c.post_id
    GROUP BY p.id
    ORDER BY p.created_at DESC
    LIMIT 50
");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<div class="publish-box">
    <h3>Quoi de neuf ?</h3>
    <form method="POST" action="post.php">
        <textarea name="content" placeholder="Partagez vos actualités..." required style="height: 100px; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;"></textarea>
        <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">Publier</button>
    </form>
</div>

<?php foreach ($posts as $post): ?>
    <div class="post-card">
        <div class="post-header">
            <div class="user-avatar"><?= substr($post['username'], 0, 1) ?></div>
            <div class="post-info">
                <h4><?= htmlspecialchars($post['username']) ?></h4>
                <span><?= htmlspecialchars($post['filiere']) ?> • <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></span>
            </div>
        </div>
        <div class="post-body"><?= nl2br(htmlspecialchars($post['content'])) ?></div>
        <div class="post-footer">
            <form method="POST" action="like.php" style="display:inline;">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <button type="submit" class="btn-action">👍 <?= $post['likes_count'] ?></button>
            </form>
            <button class="btn-action">💬 <?= $post['comments_count'] ?></button>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>