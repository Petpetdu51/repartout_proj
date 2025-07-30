<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Le fichier SQLite (chemin absolu ou relatif, ici dans le même dossier)
    $databaseFile = __DIR__ . '/database.sqlite';

    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tu peux aussi définir le mode de fetch par défaut si tu veux
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base : " . $e->getMessage());
}
