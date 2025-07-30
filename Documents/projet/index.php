<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Repar'Tout - Réparation / Montage / Matériel Informatique</title>
  <meta name="description" content="Réparation / Montage / Matériel Informatique" />
  <link rel="icon" href="assets/images/logo_site.png" sizes="32x32" />
  <link rel="stylesheet" href="assets/styles/main.css" />
</head>
<body>
    <div class="header-spacer"></div>
  <header>
    <div class="logo-title">
      <a href="index.php">
        <img src="assets/images/logo_site.png" alt="Repar'Tout Logo">
      </a>
      <a href="index.php" class="site-title">Repar'Tout</a>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="tarifs.php">Tarifs</a></li>
        <li><a href="commande.php">Commande</a></li>
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="abonnement.php">Abonnement</a></li>
      </ul>
    </nav>
    <nav>
    <ul>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <li><a href="manage_users.php" class="btn-admin">Gérer les utilisateurs</a></li>
        <?php endif; ?>
        <?php if (!empty($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <li><a href="compte.php" class="btn-profile"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
            <li><a href="logout.php" class="btn-logout">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="login.php" class="btn-login">Se connecter</a></li>
            <li><a href="register.php" class="btn-signup">S'inscrire</a></li>
        <?php endif; ?>
        

      </ul>
    </nav>

  </header>
  <div class="tagline">Réparation / Montage / Matériel Informatique</div>
  <main>
    <section class="services">
        <div class="service-card">
            <img src="assets/images/pc_fixe.png" alt="PC Fixe">
        <h2>Ordinateur Fixe</h2>
        <p>Services spécialisés en réparation de PC fixes avec précision et efficacité.</p>
        </div>
        <div class="service-card">
            <img src="assets/images/pc_portable.png" alt="PC Portable">
        <h2>Ordinateur Portable</h2>
        <p>Réparation minutieuse et efficace des PC portables.</p>
        </div>
        <div class="service-card">
            <img src="assets/images/console.png" alt="Console">
        <h2>Console</h2>
        <p>Également experts dans la réparation de consoles de jeux.</p>
        </div>
    </section>
    <section class="promo-section">
        <img src="assets/images/affiche_promo.png" alt="Promo">
        <div class="promo-content">
        <h2>L'Offre Incontournable</h2>
        <a href="commande.php">Commander</a>
        </div>
    </section>
  </main> 
  <section class="contact-section">
    <img src="assets/images/logo_site.png" alt="Logo Repar'Tout">
    <h1>Repar'Tout</h1>
    <p>Réparation / Montage / Matériel Informatique</p>
    <div class="contact-buttons">
      <a href="mailto:contact.repartout@gmail.com">contact.repartout@gmail.com</a>
      <a href="tel:0604167355">06.04.16.73.55</a>
      <a href="https://www.instagram.com/repartout51/" target="_blank" rel="noopener">INSTA: repartout51</a>
    </div>
  </section>
</body>
</html>