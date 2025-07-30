<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Repar'Tout - Abonnement</title>
  <meta name="description" content="Découvrez nos offres d'abonnement pour profiter de nos services en continu." />
  <link rel="icon" href="assets/images/logo_site.png" sizes="32x32" />
  <link rel="stylesheet" href="assets/styles/main.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Sora', Arial, sans-serif;
      background: linear-gradient(127deg, #beb9f2 0%, #c5b4d9 29%, #fcd9d2 65%, #c5b4d9 100%);
      color: #0b303b;
      min-height: 200vh; /* Ajoute de la hauteur à la page */
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    .header-spacer {
      height: 40px;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fff;
      border-radius: 20px;
      margin: 0 20px 40px 20px;
      padding: 32px 20px;
      box-shadow: 0 2px 8px #0001;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo-title {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .logo-title img {
      width: 40px;
      height: 40px;
      border-radius: 12px;
    }

    .site-title {
      font-family: 'Space Mono', monospace;
      font-size: 2rem;
      font-weight: 900;
      margin: 0;
      color: #5454d2;
      text-decoration: none;
    }

    nav ul {
      display: flex;
      gap: 24px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    nav a {
      text-decoration: none;
      color: #0b303b;
      font-weight: 600;
      font-size: 1rem;
      transition: color 0.2s;
    }

    nav a:hover,
    nav a.active {
      color: #5454d2;
    }

    .tagline {
      text-align: center;
      font-size: 2.5rem;
      margin: 60px 0 40px 0;
      font-style: italic;
      font-family: 'Space Mono', monospace;
    }

    .subscription-section {
      display: flex;
      gap: 48px;
      justify-content: center;
      margin: 60px 20px;
      flex-wrap: wrap;
    }

    .subscription-card {
      background: #6cfcc5;
      border-radius: 20px;
      padding: 40px 32px;
      width: 320px;
      box-shadow: 0 2px 8px #0001;
      text-align: center;
      transition: transform 0.2s;
      margin-bottom: 32px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .subscription-card h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: #0b303b;
    }

    .subscription-card ul {
      list-style: inside disc;
      text-align: left;
      color: #0b303b;
      font-weight: 600;
      padding-left: 0;
      margin: 0;
    }

    .subscription-card .price {
      font-weight: 900;
      font-size: 1.8rem;
      color: white;
    }

    .subscription-card .btn-subscribe {
      background: #ff9c61;
      color: #fff;
      font-weight: 700;
      padding: 14px 36px;
      border-radius: 100px;
      text-decoration: none;
      font-size: 1.1rem;
      margin-top: auto;
      transition: background 0.2s;
    }

    .subscription-card .btn-subscribe:hover {
      background: #cf2e2e;
    }

    .subscription-card.premium {
      background: #0b303b;
      color: #fff;
    }

    .subscription-card.premium ul {
      color: #fff;
    }

    .subscription-card.pro {
      background: #5454d2;
      color: #fff;
    }

    .subscription-card.pro ul {
      color: #fff;
    }

    .contact-section {
      background: linear-gradient(180deg, #8748af 0%, #34056a 53%, #cd7de2 100%);
      color: #fff;
      min-height: 200px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 20px;
      margin: 60px 0 0 0;
      padding: 30px 20px;
      position: relative;
      overflow: hidden;
    }

    .contact-section img {
      width: 100px;
      border-radius: 50%;
      margin-bottom: 16px;
      background: #fff;
      padding: 8px;
    }

    .contact-section h1 {
      font-family: 'Space Mono', monospace;
      font-size: 2rem;
      font-style: italic;
      font-weight: 900;
      margin: 0 0 8px 0;
      text-align: center;
    }

    .contact-section p {
      font-family: 'Space Mono', monospace;
      font-size: 1.1rem;
      font-style: italic;
      margin: 0 0 24px 0;
      text-align: center;
    }

    .contact-buttons {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .contact-buttons a {
      background: #000;
      color: #fff;
      border-radius: 1000px;
      padding: 12px 32px;
      font-size: 1rem;
      font-style: italic;
      font-weight: 700;
      text-decoration: none;
      margin: 4px 0;
      transition: background 0.2s;
    }

    .contact-buttons a:hover {
      background: #5454d2;
    }

    @media (max-width: 900px) {
      .subscription-section {
        flex-direction: column;
        align-items: center;
        margin: 30px 5px;
        gap: 24px;
      }
      .subscription-card {
        width: 90vw;
        max-width: 350px;
      }
      header {
        margin: 20px 5px 20px 5px;
        padding: 20px 5px;
      }
    }
  </style>
</head>
<body>
  <div class="header-spacer"></div>
  <header>
    <div class="logo-title">
      <a href="index.php">
        <img src="assets/images/logo_site.png" alt="Repar'Tout Logo" />
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
    <!-- header identique avec la vérification $_SESSION['loggedin'] -->
    <nav>
      <ul>
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
  <div class="tagline">Choisissez l'abonnement qui vous convient</div>

  <main>
    <section class="subscription-section">
      <div class="subscription-card">
        <h2>Abonnement Basic</h2>
        <p>Accès aux réparations standards avec délai standard.</p>
        <ul>
          <li>Réparations PC fixes et portables</li>
          <li>Support par email</li>
          <li>Validité 1 mois</li>
        </ul>
        <div class="price">9,99€ / mois</div>
        <a href="commande.php" class="btn-subscribe">S'abonner</a>
      </div>

      <div class="subscription-card premium">
        <h2 style="color: white;">Abonnement Premium</h2>
        <p>Priorité sur les réparations et support étendu.</p>
        <ul>
          <li>Réparations express</li>
          <li>Support par téléphone 24/7</li>
          <li>Validité 3 mois</li>
        </ul>
        <div class="price">24,99€ / 3 mois</div>
        <a href="commande.php" class="btn-subscribe">S'abonner</a>
      </div>

      <div class="subscription-card pro">
        <h2>Abonnement Pro</h2>
        <p>Services complets et assistance personnalisée.</p>
        <ul>
          <li>Réparations illimitées</li>
          <li>Support dédié</li>
          <li>Validité 1 an</li>
        </ul>
        <div class="price">69,99€ / an</div>
        <a href="commande.php" class="btn-subscribe">S'abonner</a>
      </div>
    </section>
  </main>

  <section class="contact-section">
    <img src="assets/images/logo_site.png" alt="Logo Repar'Tout" />
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
