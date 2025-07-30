<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'config.php';

// Initialisation des tentatives
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Fonction pour gérer une tentative échouée
function handleFailedLogin() {
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

// Récupération des champs
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    handleFailedLogin();
}

try {
    $stmt = $pdo->prepare('SELECT id, username, password, is_admin, is_active FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        handleFailedLogin();
    }

    // Vérifie l’état du compte
    if ($user['is_active'] != 1 && $user['is_admin'] != 1) {
        $_SESSION['login_attempts']++;
        header('Location: login.php?error=2');
        exit;
    }

    // Connexion réussie
    $_SESSION['login_attempts'] = 0;
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'] ?? '';
    $_SESSION['phone'] = $user['phone'] ?? '';
    $_SESSION['fullname'] = $user['fullname'] ?? '';

    header('Location: index.php');
    exit;

} catch (PDOException $e) {
    error_log('Erreur PDO : ' . $e->getMessage());
    header('Location: login.php?error=3'); // Erreur DB
    exit;
}

