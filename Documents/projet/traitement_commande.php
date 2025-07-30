<?php
session_start();

// Vérifie que le formulaire a été envoyé en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande.php');
    exit;
}

// Sécurise et récupère les données
$nom        = htmlspecialchars(trim($_POST['nom'] ?? ''));
$email      = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$telephone  = htmlspecialchars(trim($_POST['telephone'] ?? ''));
$type       = htmlspecialchars(trim($_POST['type-prestation'] ?? ''));
$details    = htmlspecialchars(trim($_POST['details'] ?? ''));

// Validation simple
if (!$nom || !$email || !$type || !$details) {
    echo "❌ Veuillez remplir tous les champs obligatoires.";
    exit;
}

// Adresse de destination
$to = "contact.repartout@gmail.com";

// Sujet du mail
$subject = "📦 Nouvelle commande - $type - $nom";

// Contenu du message
$message = "Nouvelle commande reçue via le site Repar'Tout :\n\n";
$message .= "👤 Nom complet : $nom\n";
$message .= "✉️ Email : $email\n";
$message .= "📞 Téléphone : $telephone\n";
$message .= "🛠️ Type de prestation : $type\n\n";
$message .= "📝 Détails de la demande :\n$details\n";

// En-têtes email
$headers = "From: noreply@repartout.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoi du mail
if (mail($to, $subject, $message, $headers)) {
    // Redirection ou message de confirmation
    echo "✅ Votre commande a bien été envoyée. Merci $nom !";
} else {
    echo "❌ Une erreur est survenue lors de l'envoi du mail. Veuillez réessayer plus tard.";
}
