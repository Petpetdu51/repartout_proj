<?php
session_start();

// Détruire toutes les variables de session
$_SESSION = [];

// Détruire la session elle-même
session_destroy();

// Rediriger vers la page d’accueil ou la page de login
header('Location: index.php');
exit;
?>
