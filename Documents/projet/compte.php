<?php
session_start();
require 'config.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];

// Si formulaire POST envoyé : mise à jour des infos (email, phone, fullname)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');

    $stmt = $pdo->prepare("UPDATE users SET email = :email, phone = :phone, fullname = :fullname WHERE id = :id");
    $stmt->execute([
        'email' => $email,
        'phone' => $phone,
        'fullname' => $fullname,
        'id' => $userId,
    ]);

    $message = "Informations mises à jour.";
}

// Récupération des infos utilisateur pour afficher dans le formulaire
$stmt = $pdo->prepare("SELECT username, email, phone, fullname FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .compte-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-top: 12px;
        }
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .message {
            color: green;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="compte-container">
        <h2>Mon Compte</h2>
        <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($user['username'] ?? '') ?></p>

        <?php if (!empty($message)): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="fullname">Nom complet :</label>
            <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>">

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">

            <label for="phone">Téléphone :</label>
            <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

            <button type="submit">Mettre à jour</button>
        </form>
        <p><a href="index.php">⬅ Retour à l'accueil</a></p>
    </div>
</body>
</html>

