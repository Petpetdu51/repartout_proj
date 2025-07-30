<?php
require 'config.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $check->execute(['username' => $username]);

        if ($check->fetchColumn() > 0) {
            $message = "❌ Ce nom d'utilisateur est déjà pris.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $insert->execute([
                'username' => $username,
                'password' => $hash
            ]);
            $message = "✅ Utilisateur créé avec succès. Vous pouvez maintenant vous connecter.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Repar'Tout</title>
    <link rel="stylesheet" href="assets/styles/main.css"> <!-- Pour le style général -->
    <style>
        body {
            font-family: 'Sora', sans-serif;
            background: linear-gradient(127deg, #beb9f2 0%, #c5b4d9 29%, #fcd9d2 65%, #c5b4d9 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-box {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .register-box h2 {
            font-family: 'Space Mono', monospace;
            text-align: center;
            color: #5454d2;
            margin-bottom: 20px;
        }
        .register-box form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .register-box input {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .register-box button {
            background: #5454d2;
            color: white;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .register-box button:hover {
            background: #3e3eb5;
        }
        .register-box .message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }
        .message.success {
            background: #e0fce0;
            color: #227722;
        }
        .message.error {
            background: #ffe1e1;
            color: #cf2e2e;
        }
        .login-link {
            text-align: center;
            margin-top: 16px;
        }
        .login-link a {
            color: #0b303b;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="register-box">
    <h2>Créer un compte</h2>

    <?php if ($message): ?>
        <div class="message <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>

    <div class="login-link">
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
</div>
</body>
</html>
