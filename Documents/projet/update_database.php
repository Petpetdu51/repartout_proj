<?php
require 'config.php';

try {
    $pdo->exec("DROP TABLE IF EXISTS users");
    echo "Table 'users' supprim�e avec succ�s.";
} catch (PDOException $e) {
    echo "Erreur lors de la suppression de la table : " . $e->getMessage();
}
