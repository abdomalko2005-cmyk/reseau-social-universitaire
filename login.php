<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        .login-box {
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
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #003cff;
            background: transparent;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }
        input:focus {
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
            border: 1px solid #ff0000;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            text-align: center;
            background-color: #fff0f0;
            color: #ff0000;
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
    <div class="login-box">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Email Académique</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Se Connecter</button>
        </form>
        <div class="links">
            Pas encore inscrit ? <a href="register.php">S'inscrire</a>
        </div>
    </div>
</body>
</html>