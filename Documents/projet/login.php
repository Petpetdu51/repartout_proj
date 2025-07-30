<?php
session_start();

// Initialiser les tentatives s'il n'existe pas
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}


// Redirige si déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'config.php';

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $_SESSION['login_attempts']++;
        header('Location: login.php?error=1');
        exit;
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        $_SESSION['login_attempts']++;
        
        if ($_SESSION['login_attempts'] >= 3) {
            header('Location: troll.html');
        } elseif ($_SESSION['login_attempts'] === 2) {
            header('Location: login.php?error=block-soon');
        } else {
            header('Location: login.php?error=1');
        }
        exit;
    }

    if ($user['is_active'] != 1) {
        header('Location: login.php?error=2');
        exit;
    }

    // Connexion réussie
    $_SESSION['login_attempts'] = 0;
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'];
    $_SESSION['user_id'] = $user['id'];

    header('Location: index.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Repar'Tout</title>
    <link rel="stylesheet" href="assets/styles/main.css"> <!-- Optionnel, pour harmoniser -->
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
        .login-box {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-box h1 {
            font-family: 'Space Mono', monospace;
            text-align: center;
            color: #5454d2;
        }
        .login-box form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .login-box input {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .login-box button {
            background: #5454d2;
            color: white;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .login-box button:hover {
            background: #3e3eb5;
        }
        .error {
            color: #cf2e2e;
            background: #ffe1e1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center;
        }
        .register-link {
            text-align: center;
            margin-top: 16px;
        }
        .register-link a {
            color: #0b303b;
            text-decoration: none;
            font-weight: bold;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Connexion</h1>

        <?php if ($errorMessage): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <div class="register-link">
            <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
        </div>
    </div>
    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            <?php
            switch ($_GET['error']) {
                case '1':
                    echo "Identifiants incorrects.";
                    break;
                case '2':
                    echo "Votre compte n'a pas encore été activé par un administrateur.";
                    break;
                case 'block-soon':
                    echo "⚠️ Attention : vous serez bloqué après une tentative supplémentaire !";
                    break;
                default:
                    echo "Une erreur inconnue est survenue.";
            }
            ?>
        </div>
    <?php endif; ?>

</body>
</html>

