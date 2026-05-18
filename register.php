<?php
session_start(); 
require 'db.php';

// Récupération des filières pour le menu déroulant
$filieres = $pdo->query("SELECT * FROM filieres ORDER BY nom ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, filiere_id, role) VALUES (?, ?, ?, ?, 'etudiant')");
    
    try {
        $stmt->execute([$_POST['username'], $_POST['email'], $hash, $_POST['filiere']]);
        header("Location: login.php?registered=success");
        exit();
    } catch (PDOException $e) {
        $error = "Erreur : L'email ou le nom d'utilisateur est déjà utilisé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ffffff;
            color: #003cff;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-box {
            width: 350px;
            padding: 40px;
            border: 1px solid #003cff;
            background: #ffffff;
        }
        h2 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-size: 11px;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #003cff;
            background: transparent;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }
        input:focus, select:focus {
            background-color: #f0f0f0;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #003cff;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0026a3;
        }
        .error {
            border: 1px solid #003cff;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            text-align: center;
            background-color: #fff0f0;
        }
        .links {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }
        .links a {
            color: #003cff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Inscription</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Email Académique</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Filière</label>
                <select name="filiere" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach($filieres as $f): ?>
                        <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Créer mon compte</button>
        </form>
        <div class="links">
            Déjà inscrit ? <a href="login.php">Se connecter</a>
        </div>
    </div>
</body>
</html>