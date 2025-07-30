<?php
require 'config.php';

$username = 'Alexandre';
$password = 'Alexandre51';

// Hasher le mot de passe avant insertion
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, is_admin, is_active) VALUES (:username, :password, :is_admin, :is_active)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password,
        'is_admin' => 1, // Valeur pour admin
        'is_active' => 1
    ]);
    echo "Utilisateur admin créé avec succès !";
} catch (PDOException $e) {
    echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
}
