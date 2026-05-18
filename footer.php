            </div>
        </main>
        
        <!-- Sidebar Droite : Statistiques -->
        <aside class="stats-sidebar">
            <div class="widget-card">
                <h3>📊 Statistiques</h3>
                <?php
                if (isset($_SESSION['user_id'])) {
                    require 'db.php';
                    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM posts");
                    $stmt->execute();
                    $posts_count = $stmt->fetchColumn();
                    
                    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users");
                    $stmt->execute();
                    $users_count = $stmt->fetchColumn();
                    
                    echo "<p>📝 Posts: <strong>$posts_count</strong></p>";
                    echo "<p>👥 Utilisateurs: <strong>$users_count</strong></p>";
                }
                ?>
            </div>
        </aside>
    </div>
</body>
</html>