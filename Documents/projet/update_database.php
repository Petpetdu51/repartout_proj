<?php
require 'config.php';

try {
    $pdo->exec("DROP TABLE IF EXISTS users");
    echo "Table 'users' supprimée avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la suppression de la table : " . $e->getMessage();
}
