<?php
session_start();
require 'config.php';

// Vérifier que l'utilisateur est connecté et admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}

// Récupérer l'ID de l'utilisateur à modifier
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: manage_users.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username'] ?? '');
    $newPassword = $_POST['password'] ?? '';

    if ($newUsername) {
        if ($newPassword) {
            // Modifier nom + mot de passe
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
            $stmt->execute(['username' => $newUsername, 'password' => $hashedPassword, 'id' => $id]);
        } else {
            // Modifier uniquement le nom
            $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
            $stmt->execute(['username' => $newUsername, 'id' => $id]);
        }
        header('Location: manage_users.php');
        exit;
    } else {
        $error = "Le nom d'utilisateur ne peut pas être vide.";
    }
}

// Charger les données de l'utilisateur
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: manage_users.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'utilisateur</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 400px; margin: 0 auto; }
        label { display: block; margin-top: 12px; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 20px; padding: 10px 15px; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Modifier l'utilisateur</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Nouveau mot de passe (laisser vide pour ne pas changer)</label>
        <input type="password" name="password">

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <p><a href="manage_users.php">← Retour à la gestion</a></p>
</body>
</html>

